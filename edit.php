<?php

    include_once("./connect.php");
    $id = '';
    $hoVaTen = '';
    $khoa = '';
    $ngaySinh = '';
    $lopID ='';


    $errHoVaTen = '';
    $errKhoa = '';

    $errNgaySinh = '';
    $isCheck =true;
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        echo $id;
        if($id){
            $sql = "SELECT * FROM sinhvien WHERE id = $id";
            $result = $conn->query($sql);
            if($result){
                $sinhVien = $result->fetch(PDO::FETCH_ASSOC);

                if($sinhVien){
                    echo "<pre>";
                    print_r($sinhVien);

                    $hoVaTen = $sinhVien["hoVaTen"];
                    $khoa = $sinhVien["khoa"];
                    $ngaySinh = $sinhVien["ngaySinh"];
                    $lopID = $sinhVien["lopID"];
                    
                }

            }


        }
    }

    if(isset($_POST["sumbit"])){
        $id = $_POST(["id"]);
        $hoVaTen = trim($_POST["hoVaTen"]);
        $khoa = $_POST["khoa"];
        $ngaySinh = $_POST["ngaySinh"];
        $lopID = $_POST["lopID"];

        echo "<pre>";
        print_r([$id,$hoVaTen,$khoa,$ngaySinh,$lopID]);
        echo "<pre>";

        //kiem tra du lieu
        if(empty($hoVaTen)){
            $errHoVaTen = "Can nhap ho va ten";
            $isCheck = false;
        }
        if(empty($khoa)){
            $errKhoa = "Can nhap ngay sinh";
            $isCheck = false;
        }
        if(empty($ngaySinh)){
            $errNgaySinh = "can nhap ngay sinh";
            $isCheck = false;   
        }

        if($isCheck){
            $sql = "UPDATE sinhvien set hoVaTen = '.$hoVaTen.', khoa= '.$khoa.', ngaySinh = '.$ngaySinh.',lopID = $lopID where id = $id" ;

            
            $reslut = $conn->query($sql);
            if($reslut){
                echo "thanhcong";
                header("Location: index.php");
            }else{
                echo "that bai";    
            }


        }
    }
    //Lay  danh sach lop va de vao trong the select
    $sql = "SELECT * FROM lop";
    $reslut =   $conn->query($sql);
    $hang = '';
    if($reslut){
        $listLop = $reslut->fetchALL(PDO::FETCH_ASSOC);

        if($listLop){
            
            foreach($listLop as $key => $item){
                $hang .= '<option '.($item["id"] == $lopID ? 'selected' : '').' value="'.$item["id"].'">'.$item["tenLop"].'</option>';
            }
        }
    }
?>

<form action="edit.php" method="post">

    <input type="hidden" name="id" value="<?= $id?>">
    <label for="">Họ và tên</label>
    <input type="text" name="hoVaTen" value="<?= $hoVaTen ?>"> 
    <span style="color: red">
        <?= $errHoVaTen; ?>
    </span> <br>

    <label for="">Khóa</label>
    <input type="text" name="khoa" value="<?= $khoa ?>">
    <span style="color: red">
        <?= $errKhoa; ?>
    </span><br>

    <label for="">ngay sinh</label>
    <input type="date" name="ngaySinh" value="<?= $ngaySinh ?>">
    <span style="color: red">
        <?= $errNgaySinh; ?>
    </span><br>
    
    <label for="">ten lop</label>
    <select name="lopID" id="" >
        <?php echo $hang;  ?>

        
    </select><br>

    <input type="submit" value="gửi" name="submit">


</form>