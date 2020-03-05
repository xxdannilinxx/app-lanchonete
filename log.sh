#!/bin/bash

echo 4 > dump && cd backend/application/logs/ && tail -f *.php

exit 0;