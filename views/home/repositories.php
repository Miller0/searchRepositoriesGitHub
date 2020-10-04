<?php

use system\App;

$title = "Поиск репозиториев"; // название формы
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/header.php");
?>

<div id="page-content">
    <div class="container text-center">

        <h3>Поиск репозиториев</h3>

        <table class="table_sort">
            <thead id="table_sort_head">
            <tr>
                <th>№</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Язык</th>
                <th>Рейтинг</th>
                <th>Дата обновления</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody id="table_sort_body">
            </tbody>
        </table>


    </div>
</div>


<script>

    $(function () {
        <? if(!empty($q)) :?>
        search('<?=$q?>');
        <?endif;?>
        sort()
    });

    function sort() {
        const getSort = ({target}) => {
            const order = (target.dataset.order = -(target.dataset.order || -1));
            const index = [...target.parentNode.cells].indexOf(target);
            const collator = new Intl.Collator(['en', 'ru'], {numeric: true});
            const comparator = (index, order) => (a, b) => order * collator.compare(
                a.children[index].innerHTML,
                b.children[index].innerHTML
            );

            for (const tBody of target.closest('table').tBodies)
                tBody.append(...[...tBody.rows].sort(comparator(index, order)));

            for (const cell of target.parentNode.cells)
                cell.classList.toggle('sorted', cell === target);
        };

        document.querySelectorAll('.table_sort thead').forEach(tableTH => tableTH.addEventListener('click', () => getSort(event)));
    }


    document.getElementById('searchGitHub').onsubmit = function (evt) {
        let q = document.getElementById('searchGitHub-q').value;
        search(q);
        return false;
    };

    function search(q) {
        window.jqxhr = $.getJSON("https://api.github.com/search/repositories?sort=stars&order=desc&per_page=20&q=" + q, function () {
            console.log("success");
        })
            .done(function (data) {

                if(data['items'].length == 0)
                    alert('Ничего не найденно');

                $('#table_sort_body tr').remove();
                $('#table_sort_head th').removeAttr('data-order');
                $('#table_sort_head th').removeAttr('class');
                $.each(data.items, function (i, item) {

                    let description = item['description'];

                    $('#table_sort_body').append('<tr>' +
                        ` <td>${i}</td>` +
                        ` <td><a href="${item['html_url']}" target="_blank">${item['full_name']}</a></td>` +
                        ` <td>${truncate(String(description), 30)}</td>` +
                        ` <td>${item['language']}</td>` +
                        ` <td>${item['stargazers_count']}</td>` +
                        ` <td>${item['created_at']}</td>` +
                        ` <td>${item['updated_at']}</td>` +
                        ` <td><a href="#" onclick="save(id =${i})">save</a></td>` +
                        '</tr>');
                });
            })
            .fail(function () {
                console.log("error");
            })
            .always(function () {
                console.log("complete");
            });
    }

    function truncate(string, maxLength) {
        return string.substring(0, maxLength);
    }

    function save(id) {
        dataAll = window.jqxhr.responseJSON.items[id];
        $.ajax('/home/saverepositories', {
            type: 'GET',  // http method
            data: {
                data:
                    {
                        fullName: dataAll['full_name'],
                        description: dataAll['description'],
                        language: dataAll['language'],
                        stargazersCount: dataAll['stargazers_count'],
                        created_at: dataAll['created_at'],
                        updated_at: dataAll['updated_at'],
                        htmlUrl: dataAll['html_url'],
                    }
            },
            success: function (data, status, xhr) {
                if (data === 'ok')
                    alert('Сохранено');
                else
                    alert('Ошибка');
            },
            error: function (jqXhr, textStatus, errorMessage) {
                console.log('error')
            }
        });
    }


</script>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/views/layouts/footer.php");
?>
