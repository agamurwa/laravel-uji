<?php

use Carbon\Carbon;

    //Merubah Format mata uang 
    function formatrupiah($angka) {
 
        if(is_numeric($angka)) {
            $format_rupiah = 'Rp ' . number_format($angka, '2', ',', '.');
            return $format_rupiah;
        } else {
            return "$angka" . " bukan angka yang valid!" . "\n";
        }
    }

    function format_date($date) {
        $output = Carbon::parse($date);
        $output = $output->format('d M Y');
        return $output;
    }

    function encode($string) {
        $output =explode("|","$string");
        return $output;
    }

    function get_value($tabel,$id,$col) {
        $output=NULL;
        $data = DB::table($tabel)->where('id',$id)->get();
        foreach ($data as $d) {
            $output=$d->$col;
        }

            return $output;  
    }

    function has_dupes($array) {
        return count($array) !== count(array_unique($array));
    }

    function decode($input,$tipe,$request) {
        $output ="";
        foreach ($request as $key => $value) {
           $q= ($value[$tipe]);
           $output = $output ."|". $q;
           
        }
        $output = substr($output,1);
        return $output;
    }

    function resultan_resep($oldresep,$newresep){
        $resultanresep = array();
        foreach ($oldresep as $key => $value) {
            if(array_key_exists($key, $oldresep) === true && array_key_exists($key, $newresep) === true){
                $resultanresep[$key] =$newresep[$key] - $value ;
            }           
            else if(array_key_exists($key, $oldresep) === true && array_key_exists($key, $newresep) === false) {
                $resultanresep[$key] = -$value;
            }
        }
        foreach ($newresep as $key => $value) {
            if(array_key_exists($key, $oldresep) === false && array_key_exists($key, $newresep) === true){
                $resultanresep[$key] = $value;
            } 
        }
        return $resultanresep;
    }

    function cek_stok ($id_obat,$jumlah_obat){
        $cek = get_value('obat',$id_obat,'stok') - $jumlah_obat;
        if ($cek < 0) {return false;}
        else {return true;}
    }

    function validasi_stok($resultanresep){
        $habis= array();
        foreach ($resultanresep as $key => $value) {
            if (cek_stok($key,$value) === false) { array_push($habis,$key); }
        }
        if ($habis !== NULL) {
            if (is_array($habis)) {
                $i=0;
                foreach ($habis as $h) {               
                    $errors['resep'[$i]] = 'Stok Obat '. get_value('obat',$h,'nama_obat') . ' ' . get_value('obat',$h,'sediaan'). ' ' . get_value('obat',$h,'dosis') . ' ' . get_value('obat',$h,'satuan') .' Tidak Cukup!';
                    $i++;
            }
                if (isset($errors)) {
                return $errors;
                }
                else {return NULL;}
            }
            else {
                $errors['resep'] = 'Stok Obat '. get_value('obat',$habis,'nama_obat') . ' ' . get_value('obat',$habis,'sediaan'). ' ' . get_value('obat',$habis,'dosis') . ' ' . get_value('obat',$habis,'satuan') .' Tidak Cukup!';
                if (isset($errors)) {
                return $errors;
                }
                else {return NULL;}
            }
        } 
    }

    function kurangi_stok($id,$jumlah) {
        $resultan = get_value('obat',$id,'stok') - $jumlah;
        DB::table('obat')->where('id',$id)->update([
            'stok' => $resultan,
        ]);
    }

    function ambil_satudata($tabel,$id) {
        if (Schema::hasColumn($tabel,'deleted')) {
           $data = DB::table($tabel)->where('id',$id)->where('deleted','<>',1)->get();
        }
        else {
            $data = DB::table($tabel)->where('id',$id)->get();
        }
      
       return ($data);
   }

   function ambil_semuadata($tabel) {
    if (Schema::hasColumn($tabel,'deleted')) {
        $data = DB::table($tabel)->orderBy('id', 'desc')->where('deleted','<>',1)->get();
    }
    else {
        $data = DB::table($tabel)->orderBy('id', 'desc')->get();     
    }
    
    return ($data);
    }

    function cek_stok_warning ($min){
        $obats= ambil_semuadata('obat');
        $minim= array();
        foreach ($obats as $obat) {
            if (cek_stok($obat->id,$min) === false) { array_push($minim,$obat->id); }
        }
        if (count($minim) > 0) {
            for ($i=0;$i<is_countable($minim);$i++) {
                 $warning[$minim[$i]]="Stok Obat ". get_value('obat',$minim[$i],'nama_obat') . " " . get_value('obat',$minim[$i],'sediaan'). " " . get_value('obat',$minim[$i],'dosis') . " " . get_value('obat',$minim[$i],'satuan') ." Mulai Menipis atau Sudah Habis";    
            return $warning;                     
            }
        }
        $warning = array();
        return $warning;
    }

    function hitung_usia($tgl_lhr) {
        $tglskrg =Carbon::now();
        $tgl_lhr = Carbon::parse($tgl_lhr);
        $usia = $tglskrg->diffInYears($tgl_lhr);
        $satuan = "Tahun";
        if ($usia < 1) {
            $usia = $tglskrg->diffInMonths($tgl_lhr);
            $satuan = "Bulan";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInDays($tgl_lhr);
            $satuan = "Hari";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInHours($tgl_lhr);
            $satuan = "Jam";
        }
        if ($usia < 1) {
            $usia = $tglskrg->diffInMinutes($tgl_lhr);
            $satuan = "Menit";
        }
        $output = $usia . ' ' . $satuan;
        return ($output);
    }

function jumlah_harga($items) {
    $jumlah=0;
    foreach ($items as $item) {
    
        $jumlah= $jumlah + $item[2];
        
    }
    return $jumlah; 
}