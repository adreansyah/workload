<?php
//** pemahaman method dan property */
// interface Kegiatan {
//     public function Makan();
//     public function Minum();
// }
//
// class Manusia implements Kegiatan{
//     public    $nama;
//     public    $tgl_lahir;
//     protected $gender;
//     private   $status;
//
//     public function Makan(){
//         return ''.$this->nama.' Butuh Makan';
//     }
//
//     public function Minum(){
//         return ''.$this->nama.' Butuh Minum';
//     }
// }
//
// class Pria extends Manusia {
//
//     public function __construct($nama,$tgl_lahir,$gender){
//         $this->nama = $nama;
//         $this->tgl_lahir = $tgl_lahir;
//         $this->gender    = $gender;
//     }
//
//     public function isStatus($the_status){
//         return $this->status = $the_status;
//     }
//
//     public function Gender($gendernya){
//         return $this->gender = $gendernya;
//     }
//
//     public function dataDiri(){
//         return [
//             "name"      => $this->nama,
//             "gender"    => $this->gender,
//             "tgl_lahir" => $this->tgl_lahir,
//             "status"    => $this->status,
//             "Makankah?" => $this->Makan(),
//             "Minumkah?" => $this->Minum(),
//         ];
//     }
// }
//
//
// $saya = new Pria('asep','01-02-91','prias');
// // echo $saya->Gender('Pria');
// // echo '</br>';
// // echo $saya->nama = 'Jono';
// // echo '</br>';
// // echo $saya->tgl_lahir = '05-06-83';
// // echo '</br>';
// $saya->status = 'jomblo';
//
// echo '<pre>';
// print_r($saya->dataDiri());
// // print_r($saya->isStatus('Jomblo'));
//
//
// function Xors($arr,$n){
//     $xor = 0;
//     for($i = 0; $i <$n; $i++){
//         $xor = $xor ^ $arr[$i];
//     }
//     return $xor * $n;
// }
// $arr = array(9, 3, 2);
// $n   = count($arr);
// echo Xors($arr,$n);
//
// $arr = array(1,3,5);
// $arr2 = array(2,4);
// $temp = [];
// for($i = 0; $i < count($arr); $i++){
//   $temp[] = $arr[$i];
//   $temp[] = $arr2[$i];
// }
// echo'<pre>';
// print_r($temp);


/**
 *
 */
class ClassController extends CI_Controller
{
  function __construct()
  {
    // code...
    $mydb = $this->db = 'default';
  }

  public function index(){

  }
}

Class Manusia {
  private $lari;

  public function __construct(){
    $this->lari = $fungsi;
  }
  public function Jalan(){
    return 'Bisa Jalan'.$this->lari;
  }

  public function Makan(){
    return 'Makan';
  }
}

Class Pria extends Manusia{

  public function Activity(){

      return $this->Jalan().' - '.$this->lari;
  }
}

$test = new Pria('off');
$tes = $test->Activity();
  echo $tes;
  // echo $test->lari ='off';
?>
<script>
class Car {
    constructor(type,color,status){
        this.type         = type;
        this._color        = null;
        this.engineStatus = status;
    }

    get color () {
        return `Warna Mobilnya adalah ${this._color}`
    }

    set color (color) {
        this._color = `${color} keren`
    }

    _isEngineOn(){
        this.engineStatus = 'on';
        console.log('Mesin ON');
    }

    _isEngineOff(){
        this.engineStatus = 'off';
        console.log('Mesin OFF');
    }

    static isEngineStart(state){
        if(state.engineStatus == 'on'){
            return 'Mesin Nyalah';
        }
        else{
            return 'Mesin Mati';
        }
    }
}

const FetchClass = new Car('E-Cvt','White','on');
console.log(FetchClass);
// console.log(Car.isEngineStart(FetchClass));
console.log(FetchClass.color = 'red');
</script>
