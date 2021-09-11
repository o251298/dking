<?php


class AdminSplitterController extends AdminBase
{
    const DEFAULT_COUNT_CATEGORY = 100;
    /*
     * УПРАВЛЕНИЕ ТОВАРАМИ
     * 1. ПОЛУЧЕНИЕ НОВЫХ ТОВАРОВ
     * 2. РЕДАКТИРОВАНИЕ КАТЕГОРИЙ и ТОВАРОВ
     * 3. ИЗМЕНЕНИЕ СТАТУСОВ ТОВАРОВ
     *
     *
     * Краткая логика работы модуля:
     * Через парсер нам попадают товары и категории.
     * У нас в системе есть свои категории. Только к ним мы должны вязать продукты, но продукты нам попадают только с категорей из прайса.
     * Приперевязки  категории мы добавляем в поле категория_айди_прод айди нашей категории.
     *
     *
     *
     *
     * UPDATE product SET category_id :new_category WHERE offer_id_category = $current_id_category;
     *
     */


    /*      Категория с прайса          Категории доступные         Кнопка "Связать категории"
     *      Носки                       Выбор категории....         Связать
     *      Трусы                       Выбор категории....         Связать
     *      Шабки                       Выбор категории....         Связать
     *
     *      ЛОГИКА РАБОТЫ
     *  В Данный екшн выводим 2 таблицы, категории с прайса и категории с магазина
     *  При нажатии на кнопку "Связать" мы передаем 2 параметра вметоде POST (category_id, offer_category_id)
     *  Данные параметры попадают в екшн который обновляет все товары где category_id = offer_category_id, устанавливая category_id значение category_id
     *
     *
     *
     */




    public function actionLinkCategory(){

        // Выводим  2 списка категорий

        $categoryInPrice = array();
        $categoryShop = array();
        $categoryShop = Category::getCategoryList(self::DEFAULT_COUNT_CATEGORY);
        $categoryInPrice = Category::getCategoryInForLink();
        if (isset($_POST['linkCategory'])){
            $options = array();
            $options['offerIdCategory'] = $_POST['offerIdCategory'];
            $options['shopIdCategory'] = $_POST['shopIdCategory'];

        }


        require_once(ROOT.'/views/splitter/category.php');
        return true;
    }

//    public function actionChangeCategory($categoryInPrice, $categoryShop){
//
//        //
//        return true;
//    }
}