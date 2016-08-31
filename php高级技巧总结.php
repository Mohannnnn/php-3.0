<?php 
	1.php多维数组
	$sites = array 
	( 
	    "runoob"=>array 
	    ( 
	        "教程", 
	        "http://www.runoob.com" 
	    ), 
	    "google"=>array 
	    ( 
	        "Google 搜索", 
	        "http://www.google.com" 
	    ), 
	    "taobao"=>array 
	    ( 
	        "淘宝", 
	        "http://www.taobao.com" 
	    ) 
	); 
	print("<pre>"); // 格式化输出数组 
	print_r($sites); 
	print("</pre>");

	echo $sites['runoob'][0] . '地址为：' . $sites['runoob'][1];//具体输出数组中的值，
	//输出：教程地址为：http://www.runoob.com


	2.php data()函数

	例如：date("Y-m-d");
	Y:年、m:月、d:日、

	3.php包含文件，include和require
		在 PHP 中，您可以在服务器执行 PHP 文件之前在该文件中插入一个文件的内容。
		include 和 require 语句用于在执行流中插入写在其他文件中的有用的代码。
		include 和 require 除了处理错误的方式不同之外，在其他方面都是相同的：
		require 生成一个致命错误（E_COMPILE_ERROR），在错误发生后脚本会停止执行。
		include 生成一个警告（E_WARNING），在错误发生后脚本会继续执行。

		例如：
		"vars.php"
		"<?php
			$color='red';
			$car='BMW';
		?>"	

		"<?php 
			include 'vars.php';
			echo "I have a $color $car"; // I have a red BMW
		?>"

	4.php文件处理,
		fopen() 函数用于在 PHP 中打开文件,fclose() 函数用于关闭打开的文件。feof()
	函数检测是否已到达文件末尾（EOF）。在循环遍历未知长度的数据时，feof() 函数很有用。fgets()
	函数用于从文件中逐行读取文件。fgetc() 函数用于从文件中逐字符地读取文件。

		$file=fopen("welcome.txt","r");

		r	只读。在文件的开头开始。
		r+	读/写。在文件的开头开始。
		w	只写。打开并清空文件的内容；如果文件不存在，则创建新文件。
		w+	读/写。打开并清空文件的内容；如果文件不存在，则创建新文件。
		a	追加。打开并向文件末尾进行写操作，如果文件不存在，则创建新文件。
		a+	读/追加。通过向文件末尾写内容，来保持文件内容。
		x	只写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。
		x+	读/写。创建新文件。如果文件已存在，则返回 FALSE 和一个错误。

		例如：

		$file = fopen('welcome.txt', 'r');

	 	while ( !feof($file)){
	 		
	 		echo fgets($file).'<br>';

	 		echo fgetc($file).'<br>';
	 	}

	 	fclose($file);

	 5.php文件上传
	 	// 允许上传的图片后缀
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		//explode(separator,string,limit)函数将字符串打散为数组
		echo $_FILES["file"]["size"];
		$extension = end($temp);     
		// 获取文件后缀名
		//current() - 返回数组中的当前元素的值
		// end() - 将内部指针指向数组中的最后一个元素，并输出
		// next() - 将内部指针指向数组中的下一个元素，并输出
		// prev() - 将内部指针指向数组中的上一个元素，并输出
		// reset() - 将内部指针指向数组中的第一个元素，并输出
		// each() - 返回当前元素的键名和键值，并将内部指针向前移动

		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
		&& in_array($extension, $allowedExts)) //in_array(search,array,type)搜索数组中是否存在指定的值
		{
			if ($_FILES["file"]["error"] > 0)
			{
				echo "错误：: " . $_FILES["file"]["error"] . "<br>";
			}
			else
			{
				echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
				echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
				echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
				echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
				
				// 判断当前目录下的 upload 目录是否存在该文件
				// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777

				if (file_exists("upload/" . $_FILES["file"]["name"]))
				//file_exists(path)函数检查文件或目录是否存在。

				{
					echo $_FILES["file"]["name"] . " 文件已经存在。 ";
				}
				else
				{
					// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
					move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
					//move_uploaded_file(file,newloc)将上传的文件移动到新位置

					echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
				}
			}
		}
		else
		{
			echo "非法的文件格式";
		}


		6.php Cookie,cookie 常用于识别用户。

		创建cookie ：setcookie("user", "runoob", time()+3600);
		//设置名为user,并赋值runoob,设定过期时间为1小时后

		取回cookie的值
		// 输出 cookie 值
		echo $_COOKIE["user"];

		// 查看所有 cookie
		print_r($_COOKIE);

		判断是否有cookie
		if (isset($_COOKIE["user"]))//isset($_COOkIE['..'])用于判断是否有cookie
			echo "欢迎 " . $_COOKIE["user"] . "!<br>";
		else
			echo "普通访客!<br>";
		
		7.php  session 变量用于存储关于用户会话（session）的信息，或者更改用户会话（session）的设置

			启动会话：session_start()且必须在<html>标签之前
			$_SESSION['views']=1; //储存session变量

			销毁 session ：使用 unset() 或 session_destroy() 函数。

			unset($_SESSION['views']);//销毁某个session
			或者
			session_destroy();//彻底销毁

		8.php 发送电子邮件。mail()函数用于脚本发送邮件

		9.php 过滤器
		filter_var() - 通过一个指定的过滤器来过滤单一的变量
		filter_var_array() - 通过相同的或不同的过滤器来过滤多个变量
		filter_input - 获取一个输入变量，并对它进行过滤
		filter_input_array - 获取多个输入变量，并通过相同的或不同的过滤器对它们进行过滤

		10.php JSON
		json_encode	对变量进行 JSON 编码,编码后为json数据了
		json_decode	对 JSON 格式的字符串进行解码，转换为 PHP 变量
		json_last_error	返回最后发生的错误

		$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
		var_dump(json_decode($json));//没有参数true时，默认返回对象
		var_dump(json_decode($json, true));//有true时，为数组

		以上代码执行结果为：
		object(stdClass)#1 (5) {
		    ["a"] => int(1)
		    ["b"] => int(2)
		    ["c"] => int(3)
		    ["d"] => int(4)
		    ["e"] => int(5)
		}//对象

		array(5) {
		    ["a"] => int(1)
		    ["b"] => int(2)
		    ["c"] => int(3)
		    ["d"] => int(4)
		    ["e"] => int(5)
		}//数组
	11.php与数据库
		(1).连接数据库
			$servername = 'localhost';
	   		$username = 'root';
	   		$password = 'wuhan';

	   		//创建连接
	   		$conn = new mysqli($servername,$username,$password);

	   		//检测连接
	   		if($conn->connect_error) {
	   			die('连接失败：'.$conn.connect_error);
	   		}else {
	   			echo "连接成功";
	   		}

	   		$conn->close();

	   	(2).创建数据库
	   		$servername = "localhost";
			$username = "root";
			$password = "wuhan";

			// 创建连接
			$conn = mysqli_connect($servername, $username, $password);
			// 检测连接
			if (!$conn) {
			    die("连接失败: " . mysqli_connect_error());
			}

			// 创建数据库
			$sql = "CREATE DATABASE myDB";
			if (mysqli_query($conn, $sql)) {
			    echo "数据库创建成功";
			} else {
			    echo "Error creating database: " . mysqli_error($conn);
			}

			mysqli_close($conn);

		(3).创建mysql表
			$servername = "localhost";
			$username = "root";
			$password = "wuhan";
			$dbname = "myDB";

			// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);
			// 检测连接
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			} 

			// 使用 sql 创建数据表
			$sql = "CREATE TABLE MyGuests (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			firstname VARCHAR(30) NOT NULL,
			lastname VARCHAR(30) NOT NULL,
			email VARCHAR(50),
			reg_date TIMESTAMP
			)";

			if ($conn->query($sql) === TRUE) {
			    echo "Table MyGuests created successfully";
			} else {
			    echo "创建数据表错误: " . $conn->error;
			}

			$conn->close();

		(4).插入数据
			$servername = "localhost";
			$username = "root";
			$password = "wuhan";
			$dbname = "myDB";

			// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);
			// 检测连接
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			} 

			$sql = "INSERT INTO MyGuests (firstname, lastname, email)
			VALUES ('John', 'Doe', 'john@example.com')";
			$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
			VALUES ('Mary', 'Moe', 'mary@example.com');";
			$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
			VALUES ('Julie', 'Dooley', 'julie@example.com')";

			if ($conn->query($sql) === TRUE) {
			    echo "新记录插入成功";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();

		(5).使用预处理语句：用于执行多个相同的sql语句，并且执行效率更高。
			$servername = "localhost";
			$username = "root";
			$password = "wuhan";
			$dbname = "myDB";

			// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);

			// 检测连接
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			}

			// 预处理及绑定
			$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES(?, ?, ?)");
			$stmt->bind_param("sss", $firstname, $lastname, $email);

			// 设置参数并执行
			$firstname = "John";
			$lastname = "Doe";
			$email = "john@example.com";
			$stmt->execute();

			$firstname = "Mary";
			$lastname = "Moe";
			$email = "mary@example.com";
			$stmt->execute();

			$firstname = "Julie";
			$lastname = "Dooley";
			$email = "julie@example.com";
			$stmt->execute();

			echo "新记录插入成功";

			$stmt->close();
			$conn->close();

		(6).读取数据
			$servername = "localhost";
			$username = "root";
			$password = "wuhan";
			$dbname = "myDB";

			// 创建连接
			$conn = new mysqli($servername, $username, $password, $dbname);
			// 检测连接
			if ($conn->connect_error) {
			    die("连接失败: " . $conn->connect_error);
			} 

			$sql = "SELECT id, firstname, lastname FROM MyGuests";

			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // 输出每行数据
			    while($row = $result->fetch_assoc()) {
			        echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"];
			    }
			} else {
			    echo "0 个结果";
			}
			$conn->close();

		(7).mysql的where子句(用mysqli_query()函数,该函数用于向mysql连接发送查询和命令)


			$con=mysqli_connect("localhost","root","wuhan","myDB");
			// 检测连接
			if (mysqli_connect_errno())
			{
				echo "连接失败: " . mysqli_connect_error();
			}

			$result = mysqli_query($con,"SELECT * FROM MyGuests
			WHERE firstname='Peter'");

			while($row = mysqli_fetch_array($result))
			{
				echo $row['firstname'] . " " . $row['lastname'];
				echo "<br>";
			}

		(8).order by 子句
			$con=mysqli_connect("localhost","root","wuhan","myDB");
			// 检测连接
			if (mysqli_connect_errno())
			{
				echo "连接失败: " . mysqli_connect_error();
			}

			$result = mysqli_query($con,"SELECT * FROM MyGuests ORDER BY email");

			while($row = mysqli_fetch_array($result))
			{
				echo $row['firstname'];
				echo " " . $row['lastname'];
				echo " " . $row['email'];
				echo "<br>";
			}

			mysqli_close($con);

		(9).update子句
			$con=mysqli_connect("localhost","root","wuhan","myDB");
			// 检测连接
			if (mysqli_connect_errno())
			{
				echo "连接失败: " . mysqli_connect_error();
			}

			mysqli_query($con,"UPDATE MyGuests SET email='1063022109@qq.com'
			WHERE firstname='Peter' AND LastName='Han'");

			mysqli_close($con);

		(10).delete子句
			$con=mysqli_connect("localhost","root","wuhan","myDB");
			// 检测连接
			if (mysqli_connect_errno())
			{
				echo "连接失败: " . mysqli_connect_error();
			}

			mysqli_query($con,"DELETE FROM MyGuests WHERE lastname='Han'");

			mysqli_close($con);
 ?>
