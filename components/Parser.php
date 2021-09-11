<?php
class Parser
{
    private $xmlUrl;

    public function __construct($xmlUrl){
        $this->xmlUrl = $xmlUrl;
    }

    private function getFileHash(){
        $xml = file_get_contents($this->xmlUrl);
        return hash('md5', $xml);
    }

    private function checkHash(){
        $error = false;
        $sourceData = Xml::getFileHashXML($this->xmlUrl);
        if ($sourceData['hash'] == $this->getFileHash()){
            $error[] = "Хеши совпадают!";
        }
        return $error;
    }

    private function parseProduct(){
        $xml = simplexml_load_file($this->xmlUrl) OR die('error parse product');
        foreach ($xml->shop->offers->offer as $offer){
                $hash_file = json_encode($offer);
                $name = strip_tags((string) $offer->name);
                $offer_id = (integer) $offer['id'];
                $category_price_id = (integer) $offer->categoryId;
                $description = strip_tags((string) $offer->description);
                $price = $offer->price;
                $image = (string) $offer->picture[0];
                $availability = (integer) $offer->stock_quantity;
                $hash = hash('md5', $hash_file);
                Product::createParseProduct($name, $offer_id, $category_price_id, $description, $price, $image, $availability, $hash, $this->xmlUrl);
        }
    }

    private function checkOfferHash($arrayProduct){
        $xml = simplexml_load_file($this->xmlUrl) OR die('error parser');
        foreach ($xml->shop->offers->offer as $offer){
            $hash_file = json_encode($offer);
            $name = $offer->name;
            $description = strip_tags((string) $offer->description);
            $offer_id = (string)$offer['id'];
            $category_price_id = (integer) $offer->categoryId;
            $image = $offer->picture[0];
            $hash = hash('md5', $hash_file);

            if ($arrayProduct[$offer_id]['hash'] !== $hash){
                Product::updateProductParser($offer_id, $name, $category_price_id, $description, $image, $hash);
                echo "Внесены обновления в следующие товары:";
                echo "<pre>";
                echo $offer_id;
                echo "</pre>";
            }
        }
    }

    private function parseCategory(){
        $xml = simplexml_load_file($this->xmlUrl) OR die('error parse category');
        $arrayCategory = array();
        foreach ($xml->shop->categories->category as $category_price){
            $hash = json_encode($category_price);
            $hash = hash('md5', $hash);
            $arrayCategory[] = (integer) $category_price['id'] . ';' . (string) $category_price . ';' . $hash . ';' . $this->xmlUrl;
        }
        Category::addCategoryParse($arrayCategory);
    }

    private function checkCategoryHash($arrayCategory){
        $xml = simplexml_load_file($this->xmlUrl) OR die('error parser');
        $newDataCategory = array();
        foreach ($xml->shop->categories->category as $category_price){
            $offer_id_category = (string) $category_price['id'];
            $offer_name_category = $category_price;
            $hash = json_encode($category_price);
            $hash = hash('md5', $hash);
            if ($arrayCategory[$offer_id_category]['hash'] !== $hash){
                // "Update category";
                $newDataCategory[] = (integer) $offer_id_category . ';' . (string) $offer_name_category . ';' . $hash;
            }
        }
        Category::updateCategoryParse($newDataCategory);
    }

    public function run(){
        $arrayProduct = Product::getProductForParse();
        if ($this->getFileHash()){

            $sourceData = Xml::getFileHashXML($this->xmlUrl);
            if($sourceData['link_xml'] == $this->xmlUrl){
                //  "Данный источник уже добавлен";
                if ($this->checkHash() == false){
                    Xml::updateHash($this->getFileHash(), $this->xmlUrl);
                    $arrayProduct = Product::getProductForParse();
                    $arrayCategory = Category::getCategoryHash();
                    echo "Парсим и обновляем хеш" . '<br>';
                    $this->checkOfferHash($arrayProduct);
                    $this->checkCategoryHash($arrayCategory);
                } else {
                    echo "Хеш прайса совпадает с предыдущим!";
                }
            } else {
                Xml::setFileHash($this->getFileHash(), $this->xmlUrl);
                echo "Дабавили новый источник";
                // забераем хеш и парсим
                $this->parseProduct();
                $this->parseCategory();
            }
        }
    }


}