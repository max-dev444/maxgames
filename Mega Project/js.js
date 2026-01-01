const fs = require("fs")
const n = JSON.parse(fs.readFileSync("input.json")).number
fs.writeFileSync("js.json", JSON.stringify({ js: n + 10 }))
