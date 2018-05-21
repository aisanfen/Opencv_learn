import cv2
import numpy as np
#1917 7959
if __name__=="__main__":
    image_orignal="./Picture_data/Original_image.jpg"
    img=cv2.imread(image_orignal)
    sp=img.shape
    size_row=sp[0]#获取原图像的宽度和长度
    size_col=sp[1]
    scale=float(str(input("输入图像变换的倍数:")))
    max_row=int(size_row*scale)
    max_col=int(size_col*scale)
   # type(max_row)用来判断类型的
    #创建一个和源图像一样的空图像
    new_img=np.zeros((max_row,max_col,3),np.uint8)
    #print(new_img.shape[0])
    #print(new_img.shape[1])方便调试
    for new_col in range(max_col-1):
        for new_row in range(max_row-1):#当超出范围了这儿就减去1，因为新图像循环的时候刚好这个减一
            x= round(new_row/scale)#返回浮点数的四舍五入值
            y=round(new_col/scale)
            if x==0:
                x=1
            if y==0:
                y=1
            #边界的处理
            if x>size_row:
                x=size_row
            if y>size_col:
                y=size_col
            try:
                new_img[new_row,new_col]=np.array(img[x][y])
                # new_img[new_row,new_col]=np.array(img[x][y])
            except:
                # 举个栗子，这儿的异常处理我就是用来判断 new_row和new_col是不是超出范围了
                print([x,y])
                print([new_row,new_col])
                print()
    cv2.imshow("original",img)
    cv2.imshow("new",new_img)
    cv2.waitKey(0)
    cv2.destroyAllWindows()
