# Find-Soup-Duplicates

When I download images from my soup I came across some files that had been downloaded twice or more.

So I had files like:

- 0054_24af_500.jpeg
- 0054_24af_720.jpeg

(The Last 3 digits are the width of that image.)

I deleted so many files by hand… but with about 35000 pics that was just… awful.

So I wrote this little script to help me find duplicates and delete them (based on resolution (not filesize)).

## Works with:
- 1 Picture = Does nothing (duh…)
- 2 Pictures = Deletes the smallest (height)
- 3 Pictures = Deletes the other 2 (height)
- 4 Pictures = Meh… Didn't test for that. Never happend.
