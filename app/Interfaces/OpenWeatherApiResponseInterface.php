<?php

namespace App\Interfaces;

interface OpenWeatherApiForecastPodInterface {
  public string $pod;
}

interface OpenWeatherApiForecastWindInterface {
  public float $speed;
  public int $deg;
  public int $gust;
}

interface OpenWeatherApiForecastCloudsInterface {
  public int $all;
}

interface OpenWeatherApiForecastMainInterface {
  public float $temp;
  public float $feels_like;
  public float $temp_min;
  public float $temp_max;
  public int $pressure;
  public int $sea_level;
  public int $grnd_level;
  public int $humidity;
  public float $temp_kf;
}

interface OpenWeatherApiForecastInterface {
  public int $dt;
  /**
   * @var OpenWeatherApiForecastMainInterface
   */ 
  public object $main;
  public array $weather;
  /**
   * @var OpenWeatherApiForecastCloudsInterface
   */
  public object $clouds;
  /**
   * @var OpenWeatherApiForecastWindInterface
   */
  public object $wind;
  public int $visibility;  
  public float $pop;
  public object $rain;
  /**
   * @var OpenWeatherApiForecastPodInterface
   */
  public object $sys;
  public string $dt_txt;
}

interface OpenWeatherApiResponseInterface
{
  public string $cod;
  /**
   * @var OpenWeatherApiForecastInterface[]
   */
  public array $list;
}