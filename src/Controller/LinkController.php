<?php

namespace App\Controller;

use App\Service\AppService;
use App\Service\LinkService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Embed\Embed;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;

/**
 * Class LinkController
 *
 * @package App\Controller
 * @Route("/link", name="link_api")
 */
class LinkController extends AbstractController
{
    /** @var Serializer */
    private $serializer;

    /** @var LoggerInterface */
    private $logger;

    /** @var AppService $appService */
    private $appService;

    /** @var LinkService $linkService */
    private $linkService;

    /** @var Embed $embed */
    private $embed;

    public function __construct(LoggerInterface $logger, AppService $appService, LinkService $linkService)
    {
        $this->serializer = SerializerBuilder::create()->build();
        $this->logger = $logger;
        $this->appService = $appService;
        $this->linkService = $linkService;
        $this->embed = new Embed();
    }

    /**
     * Méthode pour récupérer tous les liens
     *
     * @return JsonResponse
     * @Route("/all", name="links_get", methods={"GET"})
     */
    public function getLinks()
    {
        try {
            $data = $this->linkService->getAll();

            return new JsonResponse($this->serializer->serialize($data, 'json'), 200, [], true);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }

    /**
     * Méthode pour créer un lien
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @Route("/create", name="link_post", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function postLink(Request $request)
    {
        try {
            $res = [];
            $data = $this->appService->transformJsonBody($request);
            $url = $data->get("link");
            $info = $this->embed->get($url);
            $oembed = $info->getOEmbed();
            $allProp = $oembed->all();

            $providerName = $info->providerName;
            $title = $info->title;
            $author = $info->authorUrl;
            $publishDate = $info->publishedTime;

            $width = $info->code->width;
            $height = $info->code->height;

            if ($allProp["type"] === "video") {
                $res = $this->linkService->createLinkVideo(
                    [
                        "providerName" => $providerName,
                        "title" => $title,
                        "author" => $author,
                        "publishDate" => $publishDate,
                        "width" => $width,
                        "height" => $height,
                        "duration" => $allProp["duration"],
                        "URL" => $url,
                    ]
                );
            } else if ($allProp["type"] === "photo") {
                $res = $this->linkService->createLinkPhoto(
                    [
                        "providerName" => $providerName,
                        "title" => $title,
                        "author" => $author,
                        "publishDate" => $publishDate,
                        "width" => $width,
                        "height" => $height,
                        "URL" => $url,
                    ]
                );
            }

            return new JsonResponse($this->serializer->serialize($res, 'json'), 200, [], true);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }

    /**
     * Méthode pour supprimer un lien, grâce à son id
     *
     * @param string $id
     *
     * @Route("/delete/{id}", name="link_delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function deleteLink(string $id)
    {
        try {
            $res = $this->linkService->deleteLink($id);

            return $this->json(["id" => $res]);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }
}
