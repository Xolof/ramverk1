<?php

namespace Anax\View;

/**
 * View to display all books.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Gather incoming variables and use default values if not set
$items = isset($items) ? $items : null;

// Create urls for navigation
$urlToCreate = url("book/create");
$urlToDelete = url("book/delete");



?><h1>View all items</h1>

<p>
    <a href="<?= $urlToCreate ?>">Create</a> |
    <a href="<?= $urlToDelete ?>">Delete</a>
</p>

<?php if (!$items) : ?>
    <p>There are no items to show.</p>
    <?php
        return;
endif;
?>

<table class="book-table">
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Author</th>
        <th>Image</th>
    </tr>
    <?php foreach ($items as $item) : ?>
    <tr>
        <td>
            <a href="<?= url("book/update/{$item->id}"); ?>"><?= $item->id ?></a>
        </td>
        <td><?= $item->title ?></td>
        <td><?= $item->author ?></td>
        <td>
            <a
                href="<?= $item->image ?>"
                class="book-link"
            >
                <img
                    class="book-image"
                    src="<?= $item->image ?>"
                    alt="<?= $item->title ?>"
                />
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>


<p>Detta är ett exempel på hur de här modulerna kan användas:</p>

<ul>
    <li>
        <a href="https://github.com/canax/htmlform">anax/htmlform</a>
    </li>
    <li>
        <a href="https://github.com/canax/database">anax/database</a>
    </li>
    <li>
        <a href="https://github.com/canax/database-query-builder">anax/database-query-builder</a>
    </li>
    <li>
        <a href="https://github.com/canax/database-active-record">anax/database-active-record</a>
    </li>
</ul>
