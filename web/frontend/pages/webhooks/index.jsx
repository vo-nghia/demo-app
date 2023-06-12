import {
  Page,
  Button,
  Layout,
  DataTable
} from "@shopify/polaris";
import { useState } from "react";
import { useAppQuery } from "../../hooks";
import { TitleBar, useNavigate } from "@shopify/app-bridge-react";

export default function Index() {
  const [isLoading, setIsLoading] = useState(true);
  const navigate = useNavigate();

  const {
    data,
    refetch: refetchtWebhook,
    isLoading: isLoadingWebhook,
    isRefetching: isRefetchingWebhook,
  } = useAppQuery({
    url: "/api/webhooks",
    reactQueryOptions: {
      onSuccess: () => {
        setIsLoading(false);
      },
    },
  });

  const breadcrumbs = [{ content: "Home", url: "/" }];
  const headings = ['Address', 'Topic', 'Format', 'Fields'];

  const rows = !isLoadingWebhook && data?.data.map((webhook) => {
    return [
      webhook.address,
      webhook.topic,
      webhook.format,
      webhook.fields
    ];
  });

  return (
    <>
      <Page title="Webhooks List" fullWidth>
          <Layout>
            <Layout.Section>
              <TitleBar
                title="Webhooks"
                breadcrumbs={breadcrumbs}
                primaryAction={null}
              />
            </Layout.Section>
            <Layout.Section>
              <Button primary onClick={() => {
                navigate('/webhooks/add');
              }}>
                Create New Webhook
              </Button>
            </Layout.Section>
            <Layout.Section>
              { !isLoadingWebhook && (
                <DataTable
                columnContentTypes={['text', 'text', 'text', 'text']}
                headings={headings}
                rows={rows}
                />
              )
              }
            </Layout.Section>
          </Layout>
      </Page>
    </>
  );
}
