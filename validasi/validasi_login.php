<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php
    require_once("../database.php");
    // Proses dari form login
    if (isset($_POST['masuk']) && $_POST['masuk'] == "Masuk") {
        $email    = $_POST['email']; //simpan input dari username ke var username
        $password = $_POST['password']; //simpan input dari password ke var password
        $is_valid = true;

        // validasi email
    		if (empty($email)) { // cek email kosong
    			$emailError = "field is required";
    			$is_valid = false;
    		} else { // Filter digunakan untuk memvalidasi dan memfilter/menyaring text dengan filter tertentu
    			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // cek format email
    				$emailError = "invalid email address";
    				$is_valid = false;
    			} else { // jika email valid kosongkan eror
    				$emailError = "";
    			}
    		}

        // validasi password
        if (empty($password)) { // cek password kosong
            $passwordError = "field is required";
            $is_valid = false;
        } else { // Filter digunakan untuk memvalidasi dan memfilter/menyaring text dengan filter tertentu
            if (!filter_var($password, FILTER_VALIDATE_INT)) { // cek password hanya boleh angka
                $passwordError = "field must contain numeric only";
                $is_valid = false;
            } elseif (strlen($password) < 6) { // cek panjang password harus >= 6
                $passwordError = "password entered was not 6 digits long";
                $is_valid = false;
            } else { // jika password valid kosongkan error
                $passwordError = "";
            }
        }

        // jika semua input valid maka redirect ke home dengan parameter sukses
        if ($is_valid) {
            // fungsi redirect / mengirim ke halaman lain dengan membawa parameter sukses
            $sql = "SELECT * FROM pengguna WHERE email = :email and password = SHA2(:password, 0)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', $password);
            $stmt->execute();
            $valid_user = $stmt->fetch(PDO::FETCH_ASSOC);
            // jika user terdaftar
            if($valid_user){
                    // buat Session
                    session_start();
                    $_SESSION["user"] = $email;
                    // login sukses, alihkan ke halaman timeline
                    header("Location: ../index.php");
            }
            // jika ada akun belum terdaftar
            else {
                $message = "Akun Belum Terdaftar Atau Password Salah";
                header("Location: ../login.php?message=$message&email=$email&password=$password");
            }
        }
        // jika ada salah 1 input salah maka kembali ke login dengan membawa value dari masing2 input dan pesan kesalahan
        else {
            header("Location: ../login.php?email=$email&emailError=$emailError&password=$password&passwordError=$passwordError");
        }
    }
 ?>
