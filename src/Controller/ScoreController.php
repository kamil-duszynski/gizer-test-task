<?php

namespace App\Controller;

use App\Model\Score;
use App\Service\OrderManager;
use Exception;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Swagger\Annotations as SWG;

/**
 * @RouteResource("Score")
 */
class ScoreController extends AbstractController
{
    /**
     * Score List
     *
     * @Rest\Get("/")
     *
     * @SWG\Parameter(name="page", in="query", description="Page number", required=false, type="integer", format="int32")
     * @SWG\Parameter(name="limit", in="query", description="Max number of elements on page", required=false, type="integer", format="int32")
     * @SWG\Parameter(
     *     name="sort",
     *     in="query",
     *     description="Sort: name of field and direction to sort by",
     *     required=false,
     *     type="string",
     *     enum={
     *         OrderManager::SORT_BY_DATE_ASC,
     *         OrderManager::SORT_BY_DATE_DESC,
     *         OrderManager::SORT_BY_SCORE_ASC,
     *         OrderManager::SORT_BY_SCORE_DESC
     *     }
     * )
     * @SWG\Response(
     *      response=200,
     *      description="Paginated list",
     *      @SWG\Schema(
     *          type="object",
     *          @SWG\Property(
     *              property="items",
     *              type="array",
     *              @SWG\Items(
     *                  ref=@Model(
     *                      type=Score::class, groups={"score.list", "user.list"}
     *                  )
     *              )
     *          ),
     *          @SWG\Property(
     *              property="meta",
     *              type="object",
     *              @SWG\Property(property="limit", type="integer", description="Max number of elements on page"),
     *              @SWG\Property(property="page", type="integer", description="Number of this page"),
     *              @SWG\Property(property="count", type="integer", description="All elements count")
     *          )
     *      )
     * )
     * @SWG\Response(
     *      response=400,
     *      description="Bad request"
     * )
     * @SWG\Tag(name="Score")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function listAction(Request $request): Response
    {
        $query = $request->query;
        $page  = $query->getInt('page', 1);
        $limit = $query->getInt('limit', 10);
        $order = $query->get('sort', OrderManager::SORT_BY_DATE_ASC);

        try {
            $scores = $this->storage
                ->load()
                ->sort($order)
                ->getAll()
            ;

            $paginator = $this->paginator->paginate($scores, $page, $limit);
        } catch (Exception $exception) {
            return $this->renderErrors(
                [
                    $exception->getMessage(),
                ]
            );
        }

        return $this->renderResponse(
            $paginator,
            [
                'score.list',
                'user.list',
            ]
        );
    }
}
