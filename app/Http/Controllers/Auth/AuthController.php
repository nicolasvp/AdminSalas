<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Rol_usuario;
use App\Roles;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Lang;
use Session;
use RedirectsUsers;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use App\RutUtils;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    //protected $username = 'rut'; 

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'rut' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
    
            'rut' => $data['rut'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function getLogin()
    {
        return $this->showLoginForm();
    }

    /**
     * Show the application login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $view = property_exists($this, 'loginView')
                    ? $this->loginView : 'login';

        if (view()->exists($view)) {
            return view($view);
        }

        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {

        return $this->login($request);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $credentials = $this->getCredentials($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        /*----------------------------------- Consulta primero en el servicio REST ----------------------*/
     /*   $client = new Client();

        //Calcula el dv para preguntar en el rest
        $dv = RutUtils::dv($credentials['rut']);

        $rut_con_dv = $credentials['rut'].'-'.$dv;

        $password = hash('sha256',strtoupper($credentials['password']));

        $url = 'https://sepa.utem.cl/rest/api/v1/sepa/autenticar/'.$rut_con_dv.'/'.$password.'';
        
        $res = $client->request('GET',$url, 
            ['auth' => ['HJPD4IceDT', '4e878edc156b244dfc99e7433447de6b']
        ]);

        $body = json_decode($res->getBody(true));


        if($body->ok == true)
        {
            try
            {
                //Consulta si es estudiante
                $res = $client->request('GET', 'https://sepa.utem.cl/rest/api/v1/utem/estudiante/'.$rut_con_dv, [
                'auth' => ['HJPD4IceDT', '4e878edc156b244dfc99e7433447de6b']
                ]); 

                $info_alumno = json_decode($res->getBody(true));

                //Si es estudiante
                if($info_alumno)
                {
                    $usuario = User::where('rut',$credentials['rut'])->first();

                    //Si está el usuario en la bdd entonces actualiza el password
                    if($usuario)
                    {
                        $usuario->password = bcrypt($credentials['password']);
                        $usuario->save();
                    }
                    else
                    {
                        //Inserta en la base de datos al usuario
                        User::create([
                            'rut' => $credentials['rut'],
                            'email' => $info_alumno->email,
                            'nombres' => $info_alumno->nombres,
                            'apellidos' => $info_alumno->apellidos,
                            'password' => bcrypt($credentials['password'])
                            ]);

                        //Consulta por el id del rol estudiante
                        $id_rol_estudiante = Roles::where('nombre','Estudiante')->select('id')->first();

                        Rol_usuario::create([
                            'rut' => $credentials['rut'],
                            'rol_id' => $id_rol_estudiante->id
                            ]);                        
                    }

                    if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

                        return $this->handleUserWasAuthenticated($request, $throttles);
                    }
                }
            }
            catch (RequestException $e)
            {
                $var = $e->getResponse();

                    //Consulta si es docente
                    try
                    {
                        $res = $client->request('GET', 'https://sepa.utem.cl/rest/api/v1/academia/docente/'.$rut_con_dv, [
                        'auth' => ['HJPD4IceDT', '4e878edc156b244dfc99e7433447de6b']
                        ]); 

                        $info_docente = json_decode($res->getBody(true)); 

                        //Si es docente
                        if($info_docente)
                        {

                            $usuario = User::where('rut',$credentials['rut'])->first();

                            //Si está el usuario en la bdd entonces actualiza el password
                            if($usuario)
                            {
                                $usuario->password = bcrypt($credentials['password']);
                                $usuario->save();
                            }   
                            else
                            {
                                User::create([
                                    'rut' => $credentials['rut'],
                                    'email' => $info_docente->email,
                                    'nombres' => $info_docente->nombres,
                                    'apellidos' => $info_docente->apellidos,
                                    'password' => bcrypt($credentials['password'])
                                    ]);

                                $id_rol_docente = Roles::where('nombre','Docente')->select('id')->first();

                                Rol_usuario::create([
                                    'rut' => $credentials['rut'],
                                    'rol_id' => $id_rol_docente->id
                                    ]);                                
                            }

                            if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

                                return $this->handleUserWasAuthenticated($request, $throttles);
                            }                                
                         

                        }   
                    }
                    //Si no es docente ni estudiante
                    catch(RequestException $e)
                    {
                        //--------------------- Consulta en la bdd -------------------------------
                        $this->validateLogin($request);

                        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
                            $this->fireLockoutEvent($request);

                            return $this->sendLockoutResponse($request);
                        }


                        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

                            return $this->handleUserWasAuthenticated($request, $throttles);
                        }  

                        if ($throttles && ! $lockedOut) {
                            $this->incrementLoginAttempts($request);
                        }
                        //Retorna a login
                        return $this->sendFailedLoginResponse($request);
                    }                      
            
            }
          
        }
     */
        /*--------------------- Consulta en la bdd -------------------------------*/
        $this->validateLogin($request);


        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {

            return $this->handleUserWasAuthenticated($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && ! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required|numeric|digits_between:7,8', 'password' => 'required',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {

        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        return redirect()->intended($this->redirectPath());
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function getCredentials(Request $request)
    {
        return $request->only($this->loginUsername(), 'password');
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        return $this->logout();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/home');
    }

    /**
     * Get the guest middleware for the application.
     */
    public function guestMiddleware()
    {

        $guard = $this->getGuard();

        return $guard ? 'guest:'.$guard : 'guest';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'rut';
    }

    /**
     * Determine if the class is using the ThrottlesLogins trait.
     *
     * @return bool
     */
    protected function isUsingThrottlesLoginsTrait()
    {
        return in_array(
            ThrottlesLogins::class, class_uses_recursive(static::class)
        );
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return string|null
     */
    protected function getGuard()
    {

        return property_exists($this, 'guard') ? $this->guard : null;
    }

}
