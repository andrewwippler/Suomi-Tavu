<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TavuJsonTest extends TestCase
{
    /**
     * A basic feature test sentence.
     */
    public function test_json_sentence(): void
    {
        $response = $this->post('/api/tavu', ['textarea' => "\"Maijalla ei ollut kotia koko ikänään.\" Naimisissakin oli hän ollut yhtä kodittoman Pietin kanssa, joka neljän vuoden perästä kuollessaan jätti Maijan kaulaan kaksi alastonta ja turvatonta lasta."]);
        $response->assertJson(['lauset' => "\"Mai-jal-la ei ol-lut ko-ti-a ko-ko i-kä-nään.\" Nai-mi-sis-sa-kin o-li hän ol-lut yh-tä ko-dit-to-man Pie-tin kans-sa, jo-ka nel-jän vuo-den pe-räs-tä kuol-les-saan jät-ti Mai-jan kau-laan kak-si a-las-ton-ta ja tur-va-ton-ta las-ta."]);
    }

    public function test_json_word(): void
    {
        $response = $this->post('/api/tavu', ['textarea' => 'Maijalla.']);

        $response->assertJson(['lauset' => "Mai-jal-la."]);
    }

    public function test_json_numbers(): void
    {
        $response = $this->post('/api/tavu', ['textarea' => '1 223 4324.']);

        $response->assertJson(['lauset' => "1 223 4324."]);
    }

    public function test_json_symbols(): void
    {
        $response = $this->post('/api/tavu', ['textarea' => 'kaksi 2€! @ ()']);
        $response->assertJson(['lauset' => "kak-si 2€! @ ()"]);
    }
}
