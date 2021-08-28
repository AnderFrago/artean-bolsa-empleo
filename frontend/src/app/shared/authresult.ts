export interface AuthResult {
  //u: username
  u?: string;
  //r: role
  r?: string;
  id_token: string;
  expires_at?: string;
  error?: {
    message: string;
    type: string;
  };
}
