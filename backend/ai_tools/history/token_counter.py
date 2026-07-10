"""
Token Counter
=============

Accurately counts tokens using tiktoken.
"""

from typing import List, Dict, Any

class TokenCounter:
    """Counts tokens in strings and message lists."""
    
    def __init__(self, model: str = "gpt-4"):
        self.model = model
        self._encoding = None
        
    def _get_encoding(self):
        if self._encoding is None:
            try:
                # pyrefly: ignore [missing-import]
                import tiktoken
                try:
                    self._encoding = tiktoken.encoding_for_model(self.model)
                except KeyError:
                    # Fallback
                    self._encoding = tiktoken.get_encoding("cl100k_base")
            except ImportError:
                print("Error: tiktoken not installed. Run 'pip install tiktoken'")
                raise
        return self._encoding
        
    def count_string(self, text: str) -> int:
        """Count tokens in a single string."""
        if not text:
            return 0
        enc = self._get_encoding()
        return len(enc.encode(text))
        
    def count_messages(self, messages: List[Dict[str, str]]) -> int:
        """Count tokens in a list of chat messages."""
        enc = self._get_encoding()
        num_tokens = 0
        
        # Every message follows <im_start>{role/name}\n{content}<im_end>\n
        tokens_per_message = 4
        tokens_per_name = 1
        
        for message in messages:
            num_tokens += tokens_per_message
            for key, value in message.items():
                num_tokens += len(enc.encode(value))
                if key == "name":
                    num_tokens += tokens_per_name
                    
        num_tokens += 3  # every reply is primed with <im_start>assistant
        return num_tokens
