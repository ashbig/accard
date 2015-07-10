#!/bin/sh

# http://tech.zumba.com/2014/04/14/control-code-quality/

cp app/contrib/pre-commit .git/hooks/pre-commit
chmod +x .git/hooks/pre-commit
