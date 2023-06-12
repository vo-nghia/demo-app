import { useState, useCallback } from "react";
import {
  Page,
  TextField,
  FormLayout,
  Button,
  Form,
  Layout,
  ButtonGroup
} from "@shopify/polaris";
import { TitleBar, useNavigate } from "@shopify/app-bridge-react";
import { useTranslation } from "react-i18next";
import { useAuthenticatedFetch } from "../../hooks";
import { Toast } from "@shopify/app-bridge-react";

export default function Add() {
  const navigate = useNavigate();
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const { t } = useTranslation();
  const fetch = useAuthenticatedFetch();
  const [toastProps, setToastProps] = useState(emptyToastProps);
  
  const [address, setAddress] = useState('');
  const [topic, setTopic] = useState('');
  const [format, setFormat] = useState('');
  const [fields, setFields] = useState('');

  const handleSubmit = async () => {
    setIsLoading(true);

    fetch('/api/token')
      .then(response => response.json())
      .then(data => {
        const headers = {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': data.token
        };

        fetch('/api/webhooks/create', {
          method: 'POST',
          headers: headers,
          body: JSON.stringify({
            address: address,
            topic: topic,
            format: format,
            fields: fields
          })
        })
          .then(response => {
            setToastProps({
              content: t("Webhook.created"),
            });
            setAddress('');
            setTopic('');
            setFormat('');
            setFields('');
          })
          .catch(error => {
            setIsLoading(false);
            setToastProps({
              content: error,
              error: true,
            });
          });
      })
      .catch(error => {
        setIsLoading(false);
        setToastProps({
          content: error,
          error: true,
        });
      });
  };

  const toastMarkup = toastProps.content && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  const handleAddressChange = useCallback((value) => setAddress(value), []);
  const handleTopicChange = useCallback((value) => setTopic(value), []);
  const handleFormatChange = useCallback((value) => setFormat(value), []);
  const handleFieldsChange = useCallback((value) => setFields(value), []);

  return (
    <>
      {toastMarkup}
      <Page narrowWidth>
        <TitleBar title={ t("Webhook.add") } primaryAction={null} />
        <Layout.Section>
          <Form onSubmit={handleSubmit} method="post">
            <FormLayout>
              <TextField
                label="Address"
                type="text"
                value={address}
                onChange={handleAddressChange}
              />

              <TextField
                label="Topic"
                type="text"
                value={topic}
                onChange={handleTopicChange}
              />

              <TextField
                label="Format"
                type="text"
                value={format}
                onChange={handleFormatChange}
              />

              <TextField
                label="Fields"
                type="text"
                value={fields}
                onChange={handleFieldsChange}
              />

              <ButtonGroup>
                <Button submit primary>Register</Button>
                <Button onClick={() => {navigate('/webhooks');}}>Back to list</Button>
              </ButtonGroup>
            </FormLayout>
          </Form>
        </Layout.Section>
      </Page>
    </>
  );
}
