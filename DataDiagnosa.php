<?php 
include "librari/inc.koneksidb.php";
  echo "<h4><span class='icon-table'></span> Data Diagnosa - Belimbing Manis</h4>";
$batas   = 5;//banyaknya data yang ditampilkan 
$halaman = $_GET['halaman']; 
if(empty($halaman)){ 
    $posisi=0; 
    $halaman=1; 
} 
else{ 
    $posisi = ($halaman-1) * $batas; 
} 
 
//Sesuaikan perintah SQL 
$tampil="select * from tmp_penyakit a left join hamapenyakit b on a.Id_Pnykt=b.Id_Pnykt left join analisahasil c on a.id_log=c.id_log where c.id_pengguna='".$_SESSION['id_pengguna']."' group by c.id_log limit $posisi,$batas"; 
$hasil=mysql_query($tampil); 

echo "<table class='table table-striped table-condensed'>";
$no=$posisi+1; // Agar angka (penomoran) mengikuti paging 
while ($data=mysql_fetch_array($hasil)){ 
  echo "<tr><td width='30'>$no</td><td><a href='?page=detaildiagnosa&id_log=".$data['id_log']."'>".$data['JnsPnykt']."</td></tr>"; 
  $no++; 
} 
echo "</table>"; 
 
//Hitung total data dan halaman serta link 1,2,3 ... 
echo "<br>Halaman : "; 
$file="index.php"; 
 
$tampil2="select * from tmp_penyakit a left join hamapenyakit b on a.Id_Pnykt=b.Id_Pnykt left join analisahasil c on a.id_log=c.id_log where c.id_pengguna='".$_SESSION['id_pengguna']."'  group by c.id_log "; 
$hasil2=mysql_query($tampil2); 
$jmldata=mysql_num_rows($hasil2); 
$jmlhalaman=ceil($jmldata/$batas); 
 
for($i=1;$i<=$jmlhalaman;$i++) 
if ($i != $halaman) 
{ 
    echo " <a href=$_SERVER[PHP_SELF]?page=datadiagnosa&halaman=$i>$i</A> | "; 
} 
else 
{ 
    echo " <b>$i</b> | "; 
} 
echo "<p>Total Data Artikel : <b>$jmldata</b> data Diagnosa</p>"; 
?>