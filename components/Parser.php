<?php
require_once(ROOT.'/components/function.php');
class Parser
{
    private $xmlUrl;

    public function __construct($xmlUrl){
        $this->xmlUrl = $xmlUrl;
    }

    private function getFileHash(){
        if (file_exists(ROOT."/$this->xmlUrl")){
            $xml = file_get_contents($this->xmlUrl);
            return hash('md5', $xml);
        } else {
            return false;
        }

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
        return true;
    }

    private function checkOfferHash($arrayProduct){
        $updateProducts = array();
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
                $updateProducts[] = $offer_id;
            }
        }
        return $updateProducts;
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
        return true;
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
        $result = array();
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
                    $updateProduct = $this->checkOfferHash($arrayProduct);
                    if (!empty($updateProduct)){
                        $str_product = '';
                        foreach ($updateProduct as $product){
                            $str_product .= $product . ' ';
                        }
                        Logs::addLogs(" $this->xmlUrl Были обновления в такие продукты: " . $str_product);
                        $result[] = "Были обновления в такие продукты: " . $str_product;

                    }
                    $this->checkCategoryHash($arrayCategory);
                } else {
                    Logs::addLogs("$this->xmlUrl Хеш прайса совпадает с предыдущим! ");
                    $result[] = "Хеш прайса совпадает с предыдущим!";
                    //echo "Хеш прайса совпадает с предыдущим!";
                }
            } else {
                Xml::setFileHash($this->getFileHash(), $this->xmlUrl);
                //echo "Дабавили новый источник";
                // забераем хеш и парсим
                $this->parseProduct();
                $this->parseCategory();
                if (($this->parseProduct() == true) && ($this->parseCategory() == true)){
                    Logs::addLogs("$this->xmlUrl Дабавили новый источник");
                    $result[] = "Дабавили новый источник";
                }
            }
        }
        return $result;
    }


}