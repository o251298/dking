<?php


class   Pagination
{
    private $max = 10;
    private $index = 'page';
    private $current_page;
    private $total;
    private $limit;


    public function __construct($total, $currentPage, $limit, $index)
    {
        $this->total = $total;
        $this->limit = $limit;
        $this->index = $index;
        $this->amount = $this->amount();
        $this->setCurrentPage($currentPage);
    }

    public function get(){
        $links = null;

        $limits = $this->limits();

        $html = '<ul class="pagination">';

        for ($page = $limits[0]; $page <= $limits[1]; $page++){
            if ($page == $this->current_page){
                $links .= '<li class="active"><a href="#">' . $page . '</a></li>';
            } else {
                $links .= $this->generateHtml($page);
            }
        }

        if (!is_null($links)){
            if ($this->current_page > 1)
                $links = $this->generateHtml(1, '&lt;') . $links;
            if ($this->current_page < $this->amount)
                $links .= $this->generateHtml($this->amount, '&gt;');
        }
        $html .= $links . '</ul>';
        # Возвращаем html
        return $html;
    }


    private function generateHtml($page, $text = null){
        if (!$text){
            $text = $page;
        }
        $currentURI = rtrim($_SERVER['REQUEST_URI'], '/') . '/';
        $currentURI = preg_replace('~/page-[0-9]+~', '', $currentURI);

        return  '<li><a href="' . $currentURI . $this->index . $page . '">' . $text . '</a></li>';
    }

    private function limits()
    {
        # Вычисляем ссылки слева (чтобы активная ссылка была посередине)
        $left = $this->current_page - round($this->max / 2);

        # Вычисляем начало отсчёта
        $start = $left > 0 ? $left : 1;
        # Если впереди есть как минимум $this->max страниц
        if ($start + $this->max <= $this->amount)
            # Назначаем конец цикла вперёд на $this->max страниц или просто на минимум
            $end = $start > 1 ? $start + $this->max : $this->max;
        else {
            # Конец - общее количество страниц
            $end = $this->amount;
            # Начало - минус $this->max от конца
            $start = $this->amount - $this->max > 0 ? $this->amount - $this->max : 1;
        }
        # Возвращаем
        return
            array($start, $end);
    }

    # Получить текущую страницу
    private function setCurrentPage($currentPage){
        # Получаем номер страницы
        $this->current_page = $currentPage;
        # Если текущая страница боле нуля
        if ($this->current_page > 0){
            # Если текунщая страница больше общего количества страниц, придаем ей максимального значения
            if ($this->current_page > $this->amount)
                $this->current_page = $this->amount;
        } else {
            $this->current_page = 1;
        }
    }

    # Получить кол-во страниц(изходя из кол-во записей в БД и лимита)
    private function amount(){
        return round($this->total / $this->limit);
    }
}