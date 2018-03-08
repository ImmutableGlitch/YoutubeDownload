#!/usr/bin/env python
import serial
s = serial.Serial("/dev/ttyUSB0",9600)

print(s.readline())

s.write("255180180\n")
s.write("255180180\n")