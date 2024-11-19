<?php
abstract class trading_data
{
    protected $query, $query_result; 
    public $trade_data_rec = array();
    public $metadata;
    protected function construct_trading_data_collector($query, $query_result)
    {
        $this->query = $query;
        $this->query_result = $query_result;
        $this->get_query_results_metadata();
        $this->parse_result_records();
    }

    protected abstract function get_record_object_id();
    protected function get_query_results_metadata()
    {
        $this->metadata = new meta_data_record($this->query_result->{'Data Meta'});
    }

    protected function parse_result_records()
    {
        $record_object = get_class(get_object_vars($this->query_result->{$this->get_record_object_id()}));
        print_r($record_object);
        $query_results_array = (array)$record_object;
        foreach($query_results_array as $query_result_record)
        {
            $this_record = new trading_data_record($query_result_record);
            array_push($this->trade_data_rec, $this_record);
        }
    }
}

class intraday_trading_data_collection extends trading_data_collector
{
    function construct($query, $query_result)
    {
        $this->construct_trading_data_collector($query, $query_result);
    }
    protected function get_record_object_id()
    {
        return 'Time Series'(file_get_contents('https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol=IBM&interval=5min&apikey=GZ60FPOU8DHW2HSR'));
    }
}
?>
