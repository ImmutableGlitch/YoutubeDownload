#!/usr/bin/env python
import serial
s = serial.Serial("/dev/ttyUSB0",9600)

print(s.readline())

s.write("000000000\n")
s.write("000000000\n")