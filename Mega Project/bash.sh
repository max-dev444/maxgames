num=$(jq .number input.json)
echo "{ \"bash\": $((num * 3)) }" > bash.json
