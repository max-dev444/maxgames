import json, subprocess, os

workers = [
    "python python.py",
    "./c.exe",
    "node js.js",
    "bash bash.sh",
    "lua lua.lua"
]

# clear old outputs
for f in os.listdir():
    if f.endswith(".json") and f != "input.json":
        os.remove(f)

# run all workers
for cmd in workers:
    print("Running:", cmd)
    subprocess.run(cmd, shell=True)

# merge results
final = {}
for f in os.listdir():
    if f.endswith(".json") and f != "input.json":
        with open(f) as file:
            final.update(json.load(file))

print("\nFINAL RESULT:")
print(json.dumps(final, indent=2))
