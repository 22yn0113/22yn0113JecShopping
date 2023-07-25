<?php
//ファイルの読み込み
require_once 'DAO.php';

//GoodsGroupテーブルのデータを保持するクラス
class GoodsGroup
{
    public int    $groupcode; //商品分類コード
    public String $groupname; //商品分類名
}

//GoodsGroupテーブルにアクセスするクラス
class GoodsGroupDAO
{
    public function get_goodsgroup()
    {

        $dbh = DAO::get_db_connect();

        $sql = "SELECT * FROM GoodsGroup";

        $stmt = $dbh->prepare($sql);

        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetchObject('GoodsGroup')) {
            $data[] = $row;
        }
        return $data;
    }
}
