<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<center>
		<form action="login_check" method="post">
			<table>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<tr>
					<td>用户名</td>
					<td><input type="text" name="user"></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input type="text" name="pwd"></td>
				</tr>
				<tr>
					<td colspan="2"><input type="submit" value="登录"></td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>