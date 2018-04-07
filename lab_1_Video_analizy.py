# -*- coding: utf8 -*-
import cv2
if __name__=="__main__":
    cap=cv2.VideoCapture("./lab_1_data/lab_1_bad_apple.mp4")
    if cap.isOpened():
        while 1:
            ret, frame = cap.read()
            cv2.imshow("猪",frame)
            if cv2.waitKey(10) == 0:
                break
    cv2.destroyAllWindows()

