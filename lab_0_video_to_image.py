# -*- coding: utf-8 -*-
import cv2
import math


def compare_by_RGB(image_1,image_2):
    """
    基于通道和的差
    :param image_1:
    :param image_2:
    :return:
    """
    G_1 = 0
    B_1 = 0
    R_1 = 0
    G_2 = 0
    B_2 = 0
    R_2 = 0
    #第一个图像的通道和
    for x in image_1:
        for y in x:
            G_1 += y[0]
            B_1 += y[1]
            R_1 += y[2]
    #第二个图像的通道和
    for x in image_2:
        for y in x:
            G_2 += y[0]
            B_2 += y[1]
            R_2 += y[2]
    #图像矩阵各通道相似度
    inc_G = 1-math.fabs(G_1-G_2)/G_2
    inc_B = 1 - math.fabs(B_1 - B_2) / B_2
    inc_R = 1 - math.fabs(R_1 - R_2) / R_2
    dec = (inc_G+inc_B+inc_R)/3
    return dec
if __name__ == "__main__":
    #相似度阈值
    threshold_value = 0.75
    cap = cv2.VideoCapture("./lab_1_data/lab_0_video_to_image.mp4")
    count=0
    if cap.isOpened():
        #用来判断是否为第一帧
        flag=False
        while 1:
            ret, frame = cap.read()
            #缩小图片
            image=cv2.resize(frame,(32,32),interpolation=cv2.INTER_CUBIC)
            if flag==True:
                res=compare_by_RGB(image,temp)
                if res<threshold_value:
                    cv2.imwrite("./Picture_data"+str(count)+".jpg",frame)
                    count=count+1
                #记录当前帧值
                temp=image
            if flag==False:
                flag=True
                temp=image
                cv2.imshow("image",frame)
            if cv2.waitKey(10)=="q":
                break
    cv2.destroyAllWindows()

