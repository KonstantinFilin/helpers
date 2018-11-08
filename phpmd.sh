#!/bin/bash
bin/phpmd src/Helpers/ html codesize,unusedcode,naming > ./_/phpmd.html
