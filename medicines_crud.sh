#!/usr/bin/env bash
set -euo pipefail

# medicines_crud.sh
# Quick end-to-end CRUD test using curl and jq
# Usage: ./medicines_crud.sh [BASE_URL]
# Requires: curl, jq

BASE=${1:-http://localhost:8000}
API="$BASE/api/medicines"
TMPRESP=$(mktemp)

echo "Base URL: $BASE"

# 1) Create
echo "\n==> CREATE"
curl -sS -X POST "$API" \
  -H 'Content-Type: application/json' \
  -d '{"name":"Paracetamol (script)","manufacturer":"Acme","expiration_date":"2026-12-31","price":9.99}' \
  -o "$TMPRESP"
cat "$TMPRESP" | jq .
ID=$(jq -r '(.id // .data.id) // empty' "$TMPRESP")
if [[ -z "$ID" ]]; then
  echo "Failed to extract id from create response. Response saved to $TMPRESP" >&2
  exit 1
fi
echo "Created id: $ID"

# 2) Index
echo "\n==> INDEX"
curl -sS "$API" | jq .

# 3) Show
echo "\n==> SHOW"
curl -sS "$API/$ID" | jq .

# 4) Update
echo "\n==> UPDATE"
curl -sS -X PUT "$API/$ID" \
  -H 'Content-Type: application/json' \
  -d '{"name":"Paracetamol (script updated)","manufacturer":"Acme Ltd","expiration_date":"2027-06-30","price":12.50}' | jq .

# 5) Invalid create (expected validation error)
echo "\n==> INVALID CREATE (expect 422)"
HTTP_STATUS=$(curl -s -o "$TMPRESP" -w "%{http_code}" -X POST "$API" \
  -H 'Content-Type: application/json' \
  -d '{"manufacturer":"NoName","price":-5}')
echo "HTTP status: $HTTP_STATUS"
cat "$TMPRESP" | jq .

# 6) Invalid update (expect 422)
echo "\n==> INVALID UPDATE (expect 422)"
HTTP_STATUS=$(curl -s -o "$TMPRESP" -w "%{http_code}" -X PUT "$API/$ID" \
  -H 'Content-Type: application/json' \
  -d '{"name":"Bad price","manufacturer":"Acme","expiration_date":"2024-01-01","price":-100}')
echo "HTTP status: $HTTP_STATUS"
cat "$TMPRESP" | jq .

# 7) Delete
echo "\n==> DELETE"
curl -s -X DELETE "$API/$ID" -o /dev/null -w "HTTP status: %{http_code}\n"

# 8) Show after delete (expect 404)
echo "\n==> SHOW AFTER DELETE (expect 404)"
HTTP_STATUS=$(curl -s -o "$TMPRESP" -w "%{http_code}" "$API/$ID")
echo "HTTP status: $HTTP_STATUS"
cat "$TMPRESP" | jq . || true

rm -f "$TMPRESP"
echo "\nDone."

