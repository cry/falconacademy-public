import json, time, sys

contents = open("data.conf", "r").read().replace("\t", "").split("\n");

lol = {}

for key, entry in enumerate(contents):
	try:
		if entry in ["Chemistry", "Physics", "Biology"]:
			lol[entry] = {}
			subject = entry
			continue

		if 'Image' in entry:
			lol[subject]["img_url"] = entry.split(": ")[1]
			continue

		if "Module" in entry or "Option" in entry:
			lol[subject][entry] = {}
			module = entry
			continue

		if "Accent" in entry:
			lol[subject]["accent"] = entry.split(": ")[1]
			continue

		if "youtube" in entry:
			deets = entry.split(" https:")
			lol[subject][module][deets[0]] = {
				"yt_url": deets[1] + "?autoplay=1",
				"desc": "Default Description",
				"updated": int(time.time())
			}
		else:
			if entry in ["No Content", ""]:
				continue
			else:
				lol[subject][module][entry] = {
					"yt_url": "404.php",
					"desc": "Not Uploaded.",
					"updated": int(time.time())
				}
	except Exception as e:
		print "Syntax error: " + str(e)

try:handle = open("../403/data.json", "w").write(json.dumps(lol, sort_keys=True,
                  indent=4, separators=(',', ': ')))
except:print "Couldn't write."

print "Written."