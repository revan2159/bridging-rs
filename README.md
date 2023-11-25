# bridging-bpjs

# bridging-bpjs


## Publish Config

```cmd
php artisan vendor:publish --provider="Vclaim\Bridging\BridgingBpjsServiceProvider" --tag=config
```

## Usage

```env
#Confirasi .env BPJS
CONS_ID=xxxxx
SECRET_KEY=xxxX

#Config untuk Vclaim BPJS
API_BPJS_VCLAIM=https://apijkn.bpjs-kesehatan.go.id/vclaim-rest-dev/
USER_KEY_VCLAIM=xxxx

#Config untuk Vclaim BPJS
API_BPJS_ICARE=https://apijkn.bpjs-kesehatan.go.id/ihs_dev/

#Config untuk Antrol BPJS
API_BPJS_ANTROL=https://apijkn.bpjs-kesehatan.go.id/antreanrs_dev/
USER_KEY_ANTROL=xxxx


##Configurasi .env untuk sirs kemkes
USER_ID=xxxx
PASS_ID=xxxx
API_KEMKES=http://sirs.kemkes.go.id/fo/index.php/

```

```php
<?php
// configurasi config (Support laravel 7 ke atas)
config/vclaim.php
return [
	'api' => [
		'endpoint'  => env('API_BPJS','ENDPOINT-KAMU'),
		'consid'  => env('CONS_ID','CONSID-KAMU'),
		'seckey' => env('SECRET_KEY', 'SECRET-KAMU'),
		'user_key' => env('USER_KEY', 'SECRET-KAMU'),
	]
]

```

```php
<?php
// Example Controller bridging to Vclaim BPJS  (Laravel 7 ke atas)
use Bpjs\Bridging\Vclaim\BridgeVclaim;

Class SomeController
{
	protected $bridging;

	public function __construct()
	{
		$this->bridging = new BridgeVclaim();
	}

	// Example To use get Referensi diagnosa
	// Name of Method example
	public function getDiagnosa($kode)
	{
		$endpoint = 'referensi/diagnosa/'. $kode;
		return $this->bridging->getRequest($endpoint);
	}
}
```

```php
<?php
// Example Controller bridging to Vclaim BPJS  (Laravel 7 ke atas)
use Bpjs\Bridging\Icare\BridgeIcare;
use Illuminate\Http\Request;

Class SomeController
{
	protected $bridging;

	public function __construct()
	{
		$this->bridging = new BridgeIcare();
	}

	// Example To use get Referensi diagnosa
	// Name of Method example
	public function getHistory(Request $reqeust)
	{
		$data = $this->handleRequest($reqeust);
		$endpoint = 'api/rs/validate';
		return $this->bridging->postRequest($endpoint, $data);
	}

	protected function handleRequest($request)
	{
		$data['param'] = $request->nomor_kartu;
		$data['kodedokter'] = $request->kode_dokter;
		return json_encode($data);
	}
}
```

```php
<?php
// Example Controller bridging to SIRS Kemkes  (Laravel 7 ke atas)
use Kemkes\Bridging\BridgingKemkes;

Class SomeController
{
	protected $bridging;

	public function __construct()
	{
		$this->bridging = new BridgingKemkes();
	}

	// Example To use get Referensi diagnosa
	// Name of Method example
	public function getFasyankes($kode)
	{
		$endpoint = 'Fasyankes'. $kode;
		return $this->bridging->getRequest($endpoint);
	}
}
```
