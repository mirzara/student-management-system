<?php

class Admin
{
				private $database_name = 'school_rec';
				private $database_username = 'root';
				private $servername = "localhost";
				public $conn = null;
				public $user = null;
				public function __construct()
				{
				    date_default_timezone_set('Asia/Kolkata');
								$this->conn = mysqli_connect($this->servername, $this->database_username, 'root',
												$this->database_name);
								if (mysqli_connect_errno())
								{
												echo "Failed to connect to MySQL: " . mysqli_connect_error();
								}
								$this->user = $this->checkLogin();
				}

				public function checkLogin()
				{
								$cookie_name = 'zara';
								if (!isset($_COOKIE[$cookie_name]))
								{
												return - 1;
								}
								$cookie_value = $_COOKIE['zara'];
								$sql = "Select `username` from `login` where `auth`='$cookie_value'";
								$result = $this->conn->query($sql);
								if ($result->num_rows < 1)
								{
												return - 1;
								} else
								{
												$row = $result->fetch_assoc();
												return $row['username'];
								}
				}
				public function authk($username, $password)
				{
								$sql = "SELECT NULL FROM `login` where `username`='$username' and `password`='$password'";
								$result = $this->conn->query($sql);
								if ($result->num_rows > 0)
								{
												$cookie_name = 'zara';
												$ran = md5(rand(1000, 1344));
												$sql = "Update `login` SET `auth`='$ran' where `username`='$username' and `password`='$password'";
												$result = $this->conn->query($sql);
												setcookie($cookie_name, $ran, 0, "/");
												return 1;
								} else
								{
												return null;
								}
				}
				public function fee($code, $type)
				{
								if ($type == 'class')
								{
												$sql = "Select `fee` from `class_str` where `code`='$code'";
												$result = $this->conn->query($sql);
												$row = $result->fetch_assoc();
												return $row['fee'];
								} else
												if ($type == 'bus')
												{
																$sql = "Select `fee` from `bus_str` where `code`='$code'";
																$result = $this->conn->query($sql);
																$row = $result->fetch_assoc();
																return $row['fee'];
												}
				}

				public function adm_id($index)
				{
								$sql = "select `adm` from `student` where `Index`='$index'";
								$adm = $this->conn->query($sql);
								$adm_data = $adm->fetch_assoc();
								return $adm_data['adm'];
				}
				public function stu_name($index)
				{
								$sql = "select `name` from `student` where `adm`='$index'";
								$adm = $this->conn->query($sql);
								$adm_data = $adm->fetch_assoc();
								return $adm_data['name'];
				}
				public function class_n($index)
				{
								$sql = "select `class` from `class_str` where `code`='$index'";
								$adm = $this->conn->query($sql);
								$adm_data = $adm->fetch_assoc();
								return $adm_data['class'];
				}

				public function sub_code($index)
				{
								$sql = "select `name` from `sub_def` where `code`='$index'";
								$adm = $this->conn->query($sql);
								$adm_data = $adm->fetch_assoc();
								return $adm_data['name'];
				}
                	public function bus_n($index)
				{
								$sql = "select `stop` from `bus_str` where `code`='$index'";
								$adm = $this->conn->query($sql);
								$adm_data = $adm->fetch_assoc();
								return $adm_data['stop'];
				}
				public function exam($index)
				{
								$sql = "select * from `exam_def` where `exam_code`='$index'";
								$adm = $this->conn->query($sql);
								$exam_data = $adm->fetch_assoc();
								$exam = $exam_data['name'];
								$class = $exam_data['class_code'];
								$sub_code = $exam_data['sub_code'];
								$max = $exam_data['max_marks'];
								$pass = $exam_data['pass_marks'];
								$date = $exam_data['date'];
								$exam = array(
												$exam,
												$class,
												$sub_code,
												$date,
												$max,
												$pass);
								return $exam;
				}
				public function class_list($code)
				{
								$sql = "Select `adm` from `student` where `class`='$code' and `status`='0'";
								$class_ = $this->conn->query($sql);
								$string = null;
								$no = $class_->num_rows;
								$x = 1;
								while ($adm_ = $class_->fetch_assoc())
								{
												$adm = $adm_['adm'];
												$string .= $adm_['adm'];
												if ($x != $no)
												{
																$string .= ',';
												}
												$x++;
								}
								return $string;
				}

				public function __destruct()
				{
								$this->conn->close();
				}
}

?>