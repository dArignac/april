release:
	grunt
	tar czf "april-${TRAVIS_BRANCH}.tar.gz" april
	zip -r "april-${TRAVIS_BRANCH}.zip" april