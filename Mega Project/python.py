import json

n = json.load(open("input.json"))["number"]
json.dump({"python": n * 2}, open("python.json", "w"))
