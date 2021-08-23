<?php
include "config/koneksi.php";
include "library/oop.php";

$go = new oop();
$tabel= 'siswa';
$field= array(
        'lahir' => @$_POST['lahir'],
        'nis' => @$_POST['nis'],
        'nama' => (@$_POST['nama']));
$redirect = '?menu=siswa'; 
@$where = "siswaID = $_GET[id]";

if (isset($_POST['simpan'])){
    $go->simpan($con, $tabel , $field, $redirect);
}

if (isset($_GET['hapus'])){
    $go->hapus($con, $tabel, $where, $redirect);
}

if(isset($_GET['edit'])){
    $edit = $go->edit($con,$tabel,$where);
}
if(isset($_POST['update'])){
    $go->ubah($con, $tabel ,$field, $where, $redirect);
}

?>

<form method='post'>
<table align="center">
    <tr>
        <td>NIS</td>
        <td>:</td>
        <td><input type="text" class="form-control" name="nis" value="<?php echo @$edit['nis']?>"></td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><input type="text" class="form-control" name="nama" value="<?php echo @$edit['nama']?>"></td>
    </tr>
    <tr>
        <td>Tempat lahir</td>
        <td>:</td>
        <td><input type="text" class="form-control" name="lahir" value="<?php echo @$edit['lahir']?>"></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>
            <?php if(@$_GET['id']==""){?>
            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-primary">
            <?php }else{?> 
            <input type="submit" name="update" value="UPDATE" class="btn btn-success">
            <?php } ?> 

        </td>
    </tr>
</table>
</form>

<table id="example" class="display" style="width:100%">
    <thead>
    <tr>
        <th>No</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Tempat lahir</th>
        <th>Aksi</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
        $a = $go->tampil($con, $tabel);
        $no = 0;

        if ($a == ""){
            echo "<tr> <td>No Record</td> </tr>";
        }else{

        foreach($a as $r){
        $no++;
        ?>
    <tr>
        <td><?php echo $no ?></td>
        <td><?php echo $r['nis'] ?></td>
        <td><?php echo $r['nama'] ?></td>
        <td><?php echo $r['lahir'] ?></td>
        <td><a href="?menu=siswa&hapus&id=<?php echo $r ['siswaID'] ?>" onclick="return confirm('Hapus data <?php echo $r['nis']?>')">Hapus</a></td>
        <td><a href="?menu=siswa&edit&id=<?php echo $r['siswaID']?>">Edit</a></td>
    </tr>
    <?php } }?>
    </tbody>
</table>