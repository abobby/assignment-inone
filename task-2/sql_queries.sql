-- Name of the most expensive product(s)
select
    p.name
from
    products p
inner join
    (
        select
            product_id
        from
            product_price
        where
            unit_price = (select max(unit_price) from product_price)
    ) as temp
on
    p.id = temp.product_id;


-- Name of the cheapest product(s)
select
    p.name
from
    products p
inner join
    (
        select
            product_id
        from
            product_price
        where
            unit_price = (select min(unit_price) from product_price)
    ) as temp
on
    p.id = temp.product_id;


-- Per item price for 75 memory cards
select
    pp.unit_price as price
from
    product_price pp
inner join
    products p
on
    p.id = pp.product_id
where
    p.name = 'Memory Card'
    and pp.min_quantity <= 75
    and pp.max_quantity >= 75;


-- Per item price for 6 hammers
select
    pp.unit_price as price
from
    product_price pp
inner join
    products p
on
    p.id = pp.product_id
where
    p.name = 'Hammer'
    and pp.min_quantity <= 6
    and pp.max_quantity >= 6;
