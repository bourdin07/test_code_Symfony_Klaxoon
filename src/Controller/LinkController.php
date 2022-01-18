<?php

namespace App\Controller;

use App\Service\AppService;
use App\Service\LinkService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Embed\Embed;
use Psr\Log\LoggerInterface;

/**
 * Class LinkController
 *
 * @package App\Controller
 * @Route("/link", name="link_api")
 */
class LinkController extends AbstractController
{
    /** @var LoggerInterface */
    private $logger;

    /** @var AppService $appService */
    private $appService;

    /** @var Embed $embed */
    private $embed;

    public function __construct(LoggerInterface $logger, AppService $appService)
    {
        $this->logger = $logger;
        $this->appService = $appService;
        $this->embed = new Embed();
    }

    /**
     * Méthode pour récupérer tous les liens
     * @param PostRepository $postRepository
     *
     * @return JsonResponse
     * @Route("/all", name="links_get", methods={"GET"})
     */
    public function getLinks(LinkService $linkService)
    {
        try {
            $data = $linkService->getAll();

            return $this->json($data);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }

    /**
     * Méthode pour créer un lien
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \App\Service\LinkService $linkService
     *
     * @Route("/create", name="link_post", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function postLink(Request $request, LinkService $linkService)
    {
        try {
            $res = [];
            $data = $this->appService->transformJsonBody($request);
            $url = $data->get("link");
            $info = $this->embed->get($url);
            $oembed = $info->getOEmbed();

            $providerName = $info->providerName;
            $title = $info->title;
            $author = $info->authorUrl;
            $publishDate = $info->publishedTime;

            $width = $info->code->width;
            $height = $info->code->height;

            if ($providerName === "Vimeo") {
                $allProp = $oembed->all();
                $res = $linkService->createLinkVimeo(
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
            } else if ($providerName === "Flickr") {
                $res = $linkService->createLinkFlickr(
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

            return $this->json($res);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }

    /**
     * Méthode pour supprimer un lien, grâce à son id
     *
     * @param string $id
     * @param \App\Service\LinkService $linkService
     *
     * @Route("/delete/{id}", name="link_delete", methods={"DELETE"})
     *
     * @return JsonResponse
     */
    public function deleteLink(string $id, LinkService $linkService)
    {
        try {
            $res = $linkService->deleteLink($id);

            return $this->json(["id" => $res]);
        } catch (\Throwable $e) {
            $this->logger->error($e->getMessage(), $e->getTrace());

            return $this->json($e->getMessage(), 500);
        }
    }
}
