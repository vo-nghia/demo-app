import React from 'react';
import { DataTable } from '@shopify/polaris';

export const WebhookTable = ({ webhooks }) => {
    const rows = webhooks.map((webhook) => ({
        id: webhook.id,
        address: webhook.address,
        topic: webhook.topic,
        format: webhook.format,
        fields: webhook.fields.join(', ')
    }));

    const columns = [
        { Header: 'Address', accessor: 'address' },
        { Header: 'Topic', accessor: 'topic' },
        { Header: 'Format', accessor: 'format' },
        { Header: 'Fields', accessor: 'fields' },
    ];
    return <DataTable columns={columns} rows={rows} />;
};
