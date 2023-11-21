<?php
    include_once("./connect.php");
    $sql = "SELECT *, lop.tenLop FROM sinhvien INNER JOIN lop on sinhvien.lopID = lop.id";
    $result = $conn->query($sql);
    $hang = '';
    
    if($result){
        $listSinhVien = $result->fetchAll(PDO::FETCH_ASSOC);
        if($listSinhVien){
            foreach($listSinhVien as $key => $item){
                $ngay = date_create($item["ngaySinh"]);
                $ntn = date_format($ngay, 'd-m-Y');
                // echo $ntn.'<br>';
                // print_r($item);
                $hang .= '
                    <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$item["hoVaTen"].'</td>
                        <td>'.$item["khoa"].'</td>
                        <td>'.$ntn.'</td>
                        <td>'.$item["tenLop"].'</td>
                        <td><a href="edit.php?id='.$item["id"].'">Sua</a></td>
                    </tr>
                ';
            }
        }
    }


?>
<button><a href="add.php" style ="text-decoration: none">Thêm sinh viên</a></button>
<table border>
    <thead>
        <th>STT</th>
        <th>Hovaten</th>
        <th>Khoa</th>
        <th>Ngaysinh</th>
        <th>tenlop</th>
    </thead>
    <tbody>
        
        <?php 
            echo $hang; 
           
        ?>
    </tbody>
</table>