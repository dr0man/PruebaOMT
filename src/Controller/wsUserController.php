<?php
namespace App\Controller;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class wsUserController
 * @package App\Controller
 *
 * @Route(path="/api")
 * esta mal especificada la ruta?
 */
class wsUserController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("user", name="add_user", methods={"POST"})
     * Web Service that add new users by dRoman
     */
    public function addUser(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $fullName = $data['fullName'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $roles = $data['roles'];
       /* Se agrego FOS Rest Bundle, el cual depende de serializer-bundle,
        * para recibir las peticiones Json
          La anotacion @ IsGranted Se usa para permitir acceso a determinados roles.
          Si se agrega la anotacion IsGranted antes de la definicion
          de la clase, quiere decir que todas las funciones de la clase 
          solo podran ser accedidas por los roles especificados en la anotacion.
          Si se agrega antes de una funcion, quiere decir que esa 
          funcion solo podra se accedida por el rol especificado.
          Este comportamiento fuciona igual para la anotacion @ Route
        "fullName":"Pepito Perez",
        "username":"pepito_admin",
        "email":"pepito@mail.com",
        "password":"$2y$13$IMalnQpo7xfZD5FJGbEadOcqyj2mi/NQbQiI8v2wBXfjZ4nwshJlG",
        "roles":["ROLE_ADMIN"] */

        if (empty($fullName) || empty($password)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $this->userRepository->saveUser($fullName, $username, $email, $password, $roles);

        return new JsonResponse(['status' => 'User created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("pet/{id}", name="get_one_pet", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $pet = $this->userRepository->findOneBy(['id' => $id]);

        $data = [
            'id' => $pet->getId(),
            'fullName' => $pet->getFullName(),
            'email' => $pet->getEmail(),
            'userName' => $pet->getUsername(),
        ];

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("users", name="get_all_users", methods={"GET"})
     */
    public function getAllUsers(): JsonResponse
    {
        $pets = $this->userRepository->findAll();
        $data = [];

        foreach ($pets as $pet) {
            $data[] = [
                'id' => $pet->getId(),
                'name' => $pet->getFullName(),
                'email' => $pet->getEmail(),
                'user_name' => $pet->getUsername(),
            ];
        }

        return new JsonResponse($data, Response::HTTP_OK);
    }
    /* public function wsAllUsers(ManagerRegistry $doctrine): Response
    {
        $users = $doctrine->getManager()->getRepository(User::class)->getUsersArray();
        // dump($users);die;
        // return $this->json($users);
        return new JsonResponse([
            'json' => $users
        ]);
    }  @ Route ("user/{id}", name="update_user", methods={"PUT"})*/

    /**
     * @Route("user/{id}", name="update_user", methods={"PUT"})
     */
    public function updateUser($userid, Request $req): JsonResponse
    {
        if (empty($userid)) {
            $userid = $req->request->get('id');
        }
        // dump($userid);die;
        $user = $this->userRepository->findOneBy(['id' => $userid]);

        $data = json_decode($req->getContent(), true);

        empty($data['fullName']) ? true : $user->setFullName($data['fullName']);
        empty($data['username']) ? true : $user->setUserName($data['username']);
        empty($data['email']) ? true : $user->setEmail($data['email']);
        empty($data['password']) ? true : $user->setPassword($data['password']);
        empty($data['roles']) ? true : $user->setRoles($data['roles']);

        $updatedUser = $this->userRepository->update ($user);

		return new JsonResponse(['status' => 'User updated!'], Response::HTTP_OK);
    }

    /**
     * @Route("/update_role", options={"expose"=true}, name="update_role")
     */
    public function updateRole(Request $req, EntityManagerInterface $em)
    {
        $userid = $req->request->get('iduser');
        $rol = $req->request->get('rol');
        
        $user = $this->userRepository->find($userid);

        $user->setRoles([$rol]);
        $em->persist($user);
        $em->flush();

        return new JsonResponse([
             'b' => 'rol'
        ]);
    }

    public function deleteUser($id): JsonResponse
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
        $this->userRepository->removeUser($user);

        return new JsonResponse(['status' => 'User deleted'], Response::HTTP_OK);
    }
}

?>
