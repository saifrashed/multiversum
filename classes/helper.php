<?php
/**
 * User: saifeddine
 * Date: 2019-03-28
 * Time: 14:50
 */


/**
 * Class Helper
 *
 * This helper will make this very easy for me.
 */
class Helper {


    /**
     * Returns bootstrap table of given sql query.
     *
     * @param $result
     * @return string
     */
    public function createTable($result) {
        $tableHeader = true;
        $html        = '';

        $html .= '<table class="table">';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            if ($tableHeader) {
                $html .= '<tr>';

                foreach ($row as $key => $value) {
                    $html .= '<th>' . $key . '</th>';
                }

                $html .= '</tr>';

                $tableHeader = !$tableHeader;
            }

            $html .= '<tr>';

            foreach ($row as $value) {
                $html .= '<td>' . $value . '</td>';
            }

            $html .= '</tr>';

        }

        $html .= '<table>';

        return $html;
    }

}
