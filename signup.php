<?php
require_once './helpers/MemberDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $membername = $_POST['membername'];
    $zipcode = $_POST['zipcode'];
    $address = $_POST['address'];
    $tel1 = $_POST['tel1'];
    $tel2 = $_POST['tel2'];
    $tel3 = $_POST['tel3'];

    $memberDAO = new MemberDAO();

    $member = new Member();
    $member->email = $email;
    $member->password = $password;
    $member->membername = $membername;
    $member->zipcode = $zipcode;
    $member->address = $address;

    $member->tel = '';
    if ($tel1 !== '' && $tel2 !== '' && $tel3 !== '') {
        $member->tel = "{$tel1}-{$tel2}-{$tel3}";
    }

    $memberDAO->insert($member);

    header('Location: sigupEnd.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>新規会員登録</title>
</head>

<body>
    <?php include 'header2.php'; ?>

    <h1>会員登録</h1>
    <p>以下の項目を入力し、登録ボタンをクリックしてください（*は必須）</p>
    <form method="POST" action="">
        <table>
            <tr>
                <td>メールアドレス*</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td>パスワード（4文字以上）*</td>
                <td><input type="text" name="password"></td>
            </tr>
            <tr>
                <td>パスワード（再入力）*</td>
                <td><input type="text" name="password2"></td>
            </tr>
            <tr>
                <td>お名前*</td>
                <td><input type="text" name="membername"></td>
            </tr>
            <tr>
                <td>郵便番号*</td>
                <td><input type="text" name="zipcode"></td>
            </tr>
            <tr>
                <td>住所*</td>
                <td><input type="text" name="address"></td>
            </tr>
            <tr>
                <td>電話番号</td>
                <td>
                    <input type="tel" name="tel1" size="4">-
                    <input type="tel" name="tel2" size="4">-
                    <input type="tel" name="tel3" size="4">
                </td>
            </tr>
        </table>
        <form method="POST" action="signupEnd.php">
            <input type="submit" name="register" value="登録する">
        </form>
    </form>
</body>

</html>