#!/usr/bin/env bash
version=${TRAVIS_COMMIT};
if [ -z ${TRAVIS_TAG+x} ]; then
	:
else
	version=${TRAVIS_TAG};
fi

node_modules/.bin/grunt
tar czf "april-${version}.tar.gz" april
zip -r "april-${version}.zip" april