<?php
namespace Mezon\Jira;

/**
 * Jira page reader
 *
 * @author gdever
 */
trait PageReader
{

    /**
     * Method returns connection to Jira object
     *
     * @return Connection connection to Jira object
     */
    abstract protected function getConnection(): Connection;

    /**
     * Method reads all data from all pages
     *
     * @param string $endpoint
     *            endpoint which provides data
     * @return array read data
     */
    protected function readAllPages(string $endpoint): array
    {
        // initial setup
        $result = [];
        $startAt = 0;

        // main loop
        do {
            // reading data
            $page = $this->getConnection()->sendGetRequest($endpoint . $startAt);

            // additing read projects to the previous ones
            $result = array_merge($result, $page->values);

            // shifting on the next page
            $startAt += 50;
        } while (! $page->isLast);

        return $result;
    }
}
