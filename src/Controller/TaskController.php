<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use App\Service\TaskService;
use App\Service\TaskServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController.
 */
#[Route('/task')]
class TaskController extends AbstractController
{
    //private TaskRepository $taskRepository;
    //private PaginatorInterface $paginator;
    //private TaskService $taskService;
    private TaskServiceInterface $taskService;

    public function __construct(
        TaskServiceInterface $taskService
    )
    {
        $this->taskService = $taskService;
    }

    /**
     * Index action.
     *
     * @param TaskRepository $taskRepository Task repository
     *
     * @return Response HTTP response
     */
    #[Route(
        name: 'task_index',
        methods: 'GET'
    )]
    /**
     * Index action.
     *
     * @param Request            $request        HTTP Request
     * @param TaskRepository     $taskRepository Task repository
     * @param PaginatorInterface $paginator      Paginator
     *
     * @return Response HTTP response
     */
    #[Route(name: 'task_index', methods: 'GET')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);

        $pagination = $this->taskService->getPaginatedList(
            $page
        );


        return $this->render('task/index.html.twig', ['pagination' => $pagination]);
    }

    /**
     * Show action.
     *
     * @param Task $task Task entity
     *
     * @return Response HTTP response
     */
    #[Route(
        '/{id}',
        name: 'task_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET',
    )]
    public function show(Task $task): Response
    {
        return $this->render(
            'task/show.html.twig',
            ['task' => $task]
        );
    }
}