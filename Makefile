currentBranch := $(shell git rev-parse --abbrev-ref HEAD)

testing:
	git branch -D testing
	git fetch origin testing:testing
	git checkout testing
	git merge $(currentBranch)
	git push origin testing:testing
	git checkout $(currentBranch)

rebase:
	git branch -D master
	git fetch origin master:master
	git branch --set-upstream-to=origin/master  master
	git checkout master
	git pull
	git checkout $(currentBranch)
	git rebase master
	git push origin $(currentBranch):$(currentBranch)
