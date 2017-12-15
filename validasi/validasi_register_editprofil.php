<?php
# @Author: Wahid Ari <wahidari>
# @Date:   18 November 2017, 5:05
# @Copyright: (c) wahidari 2017
?>
<?php
	require_once("../auth.php");
	require_once("../database.php");

	// Atasi Undefined
	$username = $fullname = $address = $email = $phone = $password = $confirmpassword = $is_valid = "";
	$usernameError = $fullnameError = $addressError = $emailError = $phoneError = $passwordError = $confirmpasswordError = "";

	// Fungsi Untuk Mengambil Inputan Dan Simpan di Variabel
	function get_input() {
		global $username , $fullname , $address , $email , $phone , $password , $confirmpassword , $is_valid;
		$username 		   = $_POST['username']; //simpan input dari username ke var username
		$fullname 		   = $_POST['fullname']; //simpan input dari fullname ke var fullname
		$address  		   = $_POST['address'];  //simpan input address
		$email    		   = $_POST['email'];    //simpan input dari email ke var email
		$phone    		   = $_POST['phone'];    //simpan input dari email ke var email
		$password 		   = $_POST['password']; //simpan input dari password ke var password
		$confirmpassword   = $_POST['confirmpassword']; //simpan input dari confirmpassword ke var confirmpassword
		$is_valid 		   = true; // variabel jika semua input valid jika ada salah satu input invalid akan false
	}

	// Fungsi Untuk Melakukan Pengecekan Dari Setiap Inputan Di Masing - masing Fungsi
	function validate_input() {
		global $username , $fullname , $address , $email , $phone , $password , $confirmpassword , $is_valid;
		cek_username($username);
		cek_fullname($fullname);
		cek_address($address);
		cek_email($email);
		cek_phone($phone);
		cek_password($password);
		cek_confirmpassword($password, $confirmpassword);
	}

    // PROSES DARI FORM REGISTER --------------------------------------------------------------------------------
	if (isset($_POST['daftar']) && $_POST['daftar'] == "Daftar") { // isset() digunakan untuk mengecek apakah sebuah variabel telah tersedia (sudah didefenisikan) atau belum
		get_input();
		validate_input();
		// jika semua input valid maka cek di database
		if ($is_valid) {
			// Cek apakah username atau email sudah terdaftar
			$sql = "SELECT * FROM pengguna WHERE username = :username OR email = :email";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $used = $stmt->fetch(PDO::FETCH_ASSOC);
			// jika user sudah terdaftar redirectke register
            if($used){
				$class="eror";
                $message = "Username atau Email Sudah Terdaftar";
                header("Location: ../register.php?message=$message&class=$class&username=$username&fullname=$fullname&address=$address&email=$email&phone=$phone&password=$password&confirmpassword=$confirmpassword");
            }
			// jika akun belum terdaftar insert data ke database
            else {
				$sql = "INSERT INTO `pengguna`
				(`USERNAME`, `FULLNAME`, `ADDRESS`, `EMAIL`, `PASSWORD`, `PHONE`) VALUES
				(:username, :fullname, :address, :email, SHA2(:password, 0), :phone)";
	            $stmt = $db->prepare($sql);
	            $stmt->bindValue(':username', $username);
				$stmt->bindValue(':fullname', $fullname);
			    $stmt->bindValue(':address', $address);
			    $stmt->bindValue(':email', $email);
			    $stmt->bindValue(':password', $password);
				$stmt->bindValue(':phone', $phone);
	            $stmt->execute();
				$class="success";
				$message = "silahkan login untuk melanjutkan";
                header("Location: ../login.php?message=$message&class=$class");
            }
		}
		// jika ada salah 1 input salah maka kembali ke register dengan membawa value dari masing2 input dan pesan kesalahan
		else {
			header("Location: ../register.php?username=$username&usernameError=$usernameError&fullname=$fullname&fullnameError=$fullnameError&address=$address&addressError=$addressError&email=$email&emailError=$emailError&phone=$phone&phoneError=$phoneError&password=$password&passwordError=$passwordError&confirmpassword=$confirmpassword&confirmpasswordError=$confirmpasswordError");
		}
	}


	// PROSES DARI FORM EDIT PROFIL -------------------------------------------------------------------------------------------------------
	if (isset($_POST['editprofil']) && $_POST['editprofil'] == "Edit Profil") {
		get_input();
		validate_input();
		// jika semua input valid maka kembali ke profil dengan parameter sukses
        if ($is_valid) {
            // Cek apakah username atau email sudah terdaftar
			$sql = "SELECT * FROM pengguna WHERE username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            $used = $stmt->fetch(PDO::FETCH_ASSOC);
            // jika username sudah terdaftar kembali ke editprofil dengan pesan
            if($used){
                $message = "Username Sudah Terdaftar";
                header("Location: ../editprofil.php?message=$message&username=$username&fullname=$fullname&address=$address&email=$email&phone=$phone");
            }
			// jika username belum terdaftar insert data ke database
            else {
                $sql = "UPDATE `pengguna` SET `USERNAME`=:username, `FULLNAME`=:fullname, `ADDRESS`=:address, `PASSWORD`=sha2(:password,0), `PHONE`=:phone WHERE `pengguna`.`EMAIL` = :email";
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':fullname', $fullname);
                $stmt->bindValue(':address', htmlspecialchars($address));
                $stmt->bindValue(':email', $userlogin);
                $stmt->bindValue(':phone', $phone);
                $stmt->bindValue(':password', $password);

                $stmt->execute();
                //pergantian session setelah update di database
                $_SESSION["user"] = $email;
                header("Location: ../profil.php");
            }
        }
		// jika ada salah 1 input salah maka kembali ke register dengan membawa value dari masing2 input dan pesan kesalahan
		else {
            header("Location: ../editprofil.php?username=$username&usernameError=$usernameError&fullname=$fullname&fullnameError=$fullnameError&address=$address&addressError=$addressError&phone=$phone&phoneError=$phoneError&password=$password&passwordError=$passwordError&confirmpassword=$confirmpassword&confirmpasswordError=$confirmpasswordError");
        }
    }

	// FUNGSI CEK DARI SETIAP INPUT --------------------------------------------------------------------------------------------------
	// validasi username
	function cek_username ($username) {
		global $username, $is_valid, $usernameError;
		if (empty($username)) { // cek username kosong
			$usernameError = "field is required";
			$is_valid = false;
		} else { // fungsi untuk mencari suatu pola dalam objek string menggunakan regex
			if (!preg_match("/^[a-zA-Z]*$/",$username)) { // cek username bukan huruf
				$usernameError = "field must contain alphabets only with no space";
				$is_valid = false;
			} else { // jika username alid kosongkan error
				$usernameError = "";
			}
		}
	}

	// validasi fullname
	function cek_fullname($fullname) {
		global $fullname, $is_valid, $fullnameError;
		if (empty($fullname)) { // cek fullname kosong
			$fullnameError = "field is required";
			$is_valid = false;
		} else { // fungsi untuk mencari suatu pola dalam objek string menggunakan regex
			if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) { // cek fullname bukan huruf
				$fullnameError = "field must contain alphabets only";
				$is_valid = false;
			} else { // jika fullname valid kosongkan error
				$fullnameError = "";
			}
		}
	}

	// validasi address
	function cek_address($address) {
		global $address, $is_valid, $addressError;
		if (empty($address)) {
			$addressError = "field is required";
			$is_valid = false;
		} else { // fungsi untuk mencari suatu pola dalam objek string menggunakan regex
			if (!preg_match("/^[a-zA-Z0-9 ]*$/",$address)) { // cek fullname bukan huruf
				$addressError = "field must contain alphabets and numeric only";
				$is_valid = false;
			} else { // jika fullname valid kosongkan error
				$addressError = "";
			}
		}
	}

	// validasi email
	function cek_email($email) {
		global $email, $is_valid, $emailError;
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
	}

	// validasi phone
	function cek_phone($phone) {
		global $phone, $phoneError, $is_valid;
		if (empty($phone)) { // cek phone kosong
			$phoneError = "field is required";
			$is_valid = false;
		} else { // Filter digunakan untuk memvalidasi dan memfilter/menyaring text dengan filter tertentu
			if (!preg_match("/^[0-9]*$/",$phone)) { // cek phone hanya boleh angka
				$phoneError = "field must contain numeric only";
				$is_valid = false;
			} elseif (strlen($phone) != 12) { // cek panjang phone harus >= 6
				$phoneError = "phone entered was not 12 digits long";
				$is_valid = false;
			} else { // jika phone valid kosongkan error
				$phoneError = "";
			}
		}
	}

	// validasi password
	function cek_password($password) {
		global $password, $passwordError, $is_valid;
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
	}

	// validasi confirm password
	function cek_confirmpassword($password, $confirmpassword) {
		global $confirmpassword, $confirmpasswordError, $is_valid;
		if (empty($confirmpassword)) { // cek confirm password kosong
			$confirmpasswordError = "field is required";
			$is_valid = false;
		} else {
			if ($confirmpassword != $password) { // cek confirmpass dan pass tidak sama
				$confirmpasswordError = "password do not match";
				$is_valid = false;
			} else { // jika conpassword valid kosongkan error
				$confirmpasswordError = "";
			}
		}
	}
 ?>
