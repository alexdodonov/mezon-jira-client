<?php
namespace Mezon\Jira;

use Mezon\Jira\Issue\IssueRepository;

/**
 * Jira JQL
 *
 * @author gdever
 */
class JQL
{

    use ConnectionMethods, PageReader;

    /**
     * Search fields
     *
     * @var array
     */
    private $filterFields = [];

    /**
     * Constructor
     *
     * @param Connection $connection
     *            connection to Jira
     */
    public function __construct(Connection $connection)
    {
        $this->setConnection($connection);
    }

    /**
     * Method sets search field 'project'
     *
     * @param string $project
     *            project name
     * @return JQL JQL object for chain calls
     */
    public function withProject(string $project): JQL
    {
        $this->filterFields['project'] = $project;
    }

    /**
     * Method sets search field 'issuetype'
     *
     * @param string $issueType
     *            issuetype name
     * @return JQL JQL object for chain calls
     */
    public function withIssueType(string $issueType): JQL
    {
        $this->filterFields['issuetype'] = $issueType;
    }

    /**
     * Method sets search field 'assignee'
     *
     * @param string $assignee
     *            assignee
     * @return JQL JQL object for chain calls
     */
    public function withAssignee(string $assignee): JQL
    {
        $this->filterFields['assignee'] = $assignee;
    }

    /**
     * Method runs search with the defined parameters
     *
     * @return IssueRepository list of fetched issues
     */
    public function search(): IssueRepository
    {
        $endPoint = '/search?jql=';

        $parts = [];

        foreach ($this->filterFields as $fieldName => $fieldValue) {
            $parts[] = $fieldName . '="' . $fieldValue . '"';
        }

        $endPoint .= implode('&', $parts);

        $result = $this->readAllPages($endPoint . '&startAt=');

        $this->filterFields = [];
    }
}
